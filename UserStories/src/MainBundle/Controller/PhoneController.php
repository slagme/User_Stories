<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Phone;
use MainBundle\Form\PhoneType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class PhoneController extends Controller
{
    /**
     * @Route ("/{id}/addPhone")
     * @Methos ("Post")
     */

    public function addEmailAction (Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $contact=$em->getRepository('MainBundle:Contact')->find($id);

        if (!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $phone = new Phone();

        $formPhone=$this->createForm(PhoneType::class, $phone);
        $formPhone->handleRequest($request);

        if($formPhone->isSubmitted() && $formPhone->isValid()) {
            $phone->setContact($contact);
            $contact->addPhone($phone);

            $em->persist($phone);
            $em->flush();
        }

        return $this->redirectToRoute('main_contact_show', ['id'=>$id]);

    }

    /**
     * @Route("/{id}/removePhone")
     * @Method("POST")
     */

    public function deleteEmailAction (Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $contact=$em->getRepository('MainBundle:Contact')->find($id);

        if (!$contact){
            throw $this->createNotFoundException('Contact not Found');
        }

        $phone=$em->getRepository('MainBundle:Email')->find($request->request->get('phone_id'));

        if (!$phone){
            throw $this->createNotFoundException('Phone not found');
        }

        $contact->removePhone($phone);

        $em->remove($phone);
        $em->flush();

        return $this->redirectToRoute('main_contact_show', ['id'=> $id]);
    }

}

