<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Email;
use MainBundle\Entity\Contact;
use MainBundle\Form\EmailType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class EmailController extends Controller
{
    /**
     * @Route ("/{id}/addEmail")
     * @Method ("POST")
     */

    public function addEmailAction (Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $contact=$em->getRepository('MainBundle:Contact')->find($id);

        if (!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $email = new Email();

        $formEmail=$this->createForm(EmailType::class, $email);
        $formEmail->handleRequest($request);

        if($formEmail->isSubmitted() && $formEmail->isValid()) {
            $email->setContact($contact);
            $contact->addEmail($email);

            $em->persist($email);
            $em->flush();
        }

        return $this->redirectToRoute('main_contact_show', ['id'=>$id]);

        }

        /**
        * @Route("/{id}/deleteEmail")
        * @Method("POST")
        */

        public function deleteEmailAction (Request $request, $id)
        {
            $em=$this->getDoctrine()->getManager();
            $contact=$em->getRepository('MainBundle:Contact')->find($id);

            if (!$contact){
                throw $this->createNotFoundException('Contact not Found');
            }

            $email=$em->getRepository('MainBundle:Email')->find($request->request->get('email_id'));

            if (!$email){
                throw $this->createNotFoundException('Email not found');
            }

            $contact->removeEmail($email);


            $em->remove($email);
            $em->flush();

            return $this->redirectToRoute('main_contact_show', ['id'=> $id]);
        }

    }

