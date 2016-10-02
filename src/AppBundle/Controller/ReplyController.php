<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Reply;
use AppBundle\Entity\Subject;
use AppBundle\Form\Type\ReplyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route(path="/replies")
 */
class ReplyController extends Controller
{
    /**
     * @Route(path="/{id}/voteUpReply", methods={"GET"}, name="voteUpReply")
     * @Template()
     */

    //Deal the up vote on a reply
    public function voteUpReplyAction($id){
        $reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
        $voteActuel = $reply->getVote();
        $voteActuel++;
        $reply->setVote($voteActuel);
        $this->getDoctrine()->getManager()->flush();

        $subjectId = $reply->getSubject()->getId();

        return $this->redirectToRoute('subject_single', [ 'id' => $subjectId]);
    }

    /**
     * @Route(path="/{id}/voteDownReply", methods={"GET"}, name="voteDownReply")
     * @Template()
     */

    //Deal the down vote on a reply
    public function voteDownReplyAction($id){
        $reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
        $voteActuel = $reply->getVote();
        $voteActuel--;
        $reply->setVote($voteActuel);
        $this->getDoctrine()->getManager()->flush();

        $subjectId = $reply->getSubject()->getId();

        return $this->redirectToRoute('subject_single', [ 'id' => $subjectId]);
    }

    /**
     * @Route(path="/{id}/delete", methods={"GET"}, name="deleteReply")
     * @Template()
     */
    //Deal the delete action on a reply
    public function deleteReplyAction($id){
        $reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
        $short = $this->getDoctrine()->getManager();
        $short->remove($reply);
        $short->flush();

        $subjectId = $reply->getSubject()->getId();

        return $this->redirectToRoute('subject_single', [ 'id' => $subjectId]);
    }


}