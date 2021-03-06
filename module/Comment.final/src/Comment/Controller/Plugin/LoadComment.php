<?php
/**
 * ZF2 Buch Kapitel 20
 * 
 * Das Buch "Zend Framework 2 - Von den Grundlagen bis zur fertigen Anwendung"
 * von Ralf Eggert ist im Addison-Wesley Verlag erschienen. 
 * ISBN 978-3-8273-2994-3
 * 
 * @package    Comment
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Alle Listings sind urheberrechtlich geschützt!
 * @link       http://www.zendframeworkbuch.de/ und http://www.awl.de/2994
 */

/**
 * namespace definition and usage
 */
namespace Comment\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Comment\Entity\CommentEntityInterface;
use Comment\Service\CommentServiceInterface;

/**
 * Load comment factory
 * 
 * Loads comment and creates redirect if not available
 * 
 * @package    Comment
 */
class LoadComment extends AbstractPlugin
{
    /**
     * @var CommentServiceInterface
     */
    protected $commentService;

    /**
     * Constructor
     *
     * @param  CommentServiceInterface $commentService
     */
    public function __construct(CommentServiceInterface $commentService)
    {
        $this->setCommentService($commentService);
    }

    /**
     * Sets comment commentService
     *
     * @param  CommentServiceInterface $commentService
     * @return AbstractHelper
     */
    public function setCommentService(CommentServiceInterface $commentService = null)
    {
        $this->commentService = $commentService;
        return $this;
    }
    
    /**
     * Returns CommentService
     *
     * @return CommentServiceInterfaceInterface
     */
    public function getCommentService()
    {
        return $this->commentService;
    }
    
    /**
     * Load comment or create redirect
     *
     * @return CommentEntityInterface|false
     */
    public function __invoke()
    {
        // get controller
        $controller = $this->getController();
        
        // read id from route and check
        $id = (int) $controller->params()->fromRoute('id', 0);
        if (!$id) {
            $controller->redirect()->toRoute('comment-admin');
            return false;
        }
        
        // get comment
        $comment = $this->getCommentService()->fetchSingleById($id);
        
        // check comment
        if ($comment === false) {
            $controller->redirect()->toRoute('comment-admin');
            return false;
        }
        
        // return comment
        return $comment;
    }
}
