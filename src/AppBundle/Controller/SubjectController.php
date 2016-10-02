<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reply;
use AppBundle\Entity\Subject;
use AppBundle\Form\Type\ReplyType;
use AppBundle\Form\Type\SubjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/subjects")
 */
class SubjectController extends Controller
{
    /**
     * @Route(path="/", methods={"GET", "POST"}, name="subject_index")
     * @Template()
     */

    //Deal the call of the not resolved list
    public function indexAction()
    {
        return [
            'subjects' => $this->getDoctrine()->getRepository(Subject::class)->findNotResolved()
        ];
    }


    /**
     * @Route(path="/create", methods={"GET", "POST"}, name="subject_create")
     * @Template()
     */


    //Deal the create action from the form and display it
    public function createAction(Request $request){

        $subjectObject = new Subject();
        $subjectCreateForm = $this->createForm(SubjectType::class, $subjectObject);

        $subjectCreateForm->handleRequest($request);
        if($subjectCreateForm->isValid()){
            $this->getDoctrine()->getManager()->persist($subjectObject);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subject_index');
        }

        return [
            'subjectCreateForm' => $subjectCreateForm->createView()
        ];

    }

    /**
     * @Route(path="/resolved", methods={"GET"}, name="subject_index_r")
     * @Template()
     */

    //Deal the call of the resolved list
    public function resolvedAction()
    {
        return [
            'subjects_resolved' => $this->getDoctrine()->getRepository(Subject::class)->findResolved()
        ];
    }

    /**
     * @Route(path="/{id}/resolve", methods={"GET"}, name="resolve")
     * @Template()
     */

    //Deal the "make this resolved" action
    public function resolveAction($id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);

        $subject->setResolved(true);
        $this->getDoctrine()->getManager()->flush();


        return $this->redirectToRoute('subject_index_r');
    }

    /**
     * @Route(path="/{id}", methods={"GET", "POST"}, name="subject_single")
     * @Template()
     */

    //Deal the display of the subject the user clicked on and the form to reply
    public function showAction(Request $request, $id){

        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);

        $reply = new Reply();
        $reply->setSubject($subject);

        $form = $this->createForm(ReplyType::class, $reply);

        $form->handleRequest($request);
        if($form->isValid()){
            $this->getDoctrine()->getManager()->persist($reply);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subject_single', [ 'id' => $id]);
        }

        return [
            'subject' => $subject,
            'form' => $form->createView()
        ];
    }


    /**
     * @Route(path="/{id}/voteUp", methods={"GET"}, name="voteUp")
     * @Template()
     */

    //Deal the up vote action on a subject (any kind)
    public function voteUpAction($id){
            $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
            $voteActuel = $subject->getVote();
            $voteActuel++;
            $subject->setVote($voteActuel);
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('subject_index');
    }


    /**
     * @Route(path="/{id}/voteDown", methods={"GET"}, name="voteDown")
     * @Template()
     */


    //Deal the down vote action on a subject (any kind)
    public function voteDownAction($id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        $voteActuel = $subject->getVote();
        $voteActuel--;
        $subject->setVote($voteActuel);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('subject_index');
    }

    /**
     * @Route(path="/{id}/delete", methods={"GET"}, name="deleteSubject")
     * @Template()
     */
    //Deal the delete action on a subject
    public function deleteAction($id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        $short = $this->getDoctrine()->getManager();
        $short->remove($subject);
        $short->flush();

        return $this->redirectToRoute('subject_index');
    }


}
