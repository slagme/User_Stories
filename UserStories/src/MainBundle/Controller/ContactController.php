<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Address;
use MainBundle\Entity\Contact;
use MainBundle\Form\AddressType;
use MainBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    /**
     * @Route("/new")
     * @Method("GET")
     * @Template(":Contact:new.html.twig")
     */
    public function newAction()
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact,
            ['action' => $this->generateUrl('main_contact_new')]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/new")
     * @Template(":Contact:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);
            $em->flush();
            
            return $this->redirectToRoute('main_contact_show', ['id' => $contact->getId()]);
        }

        return ['form' => $form->createView()];
    }

        /**
     * @Route("/{id}/modify/")
     * @Method("POST")
     * @Template("Contact:modify.html.twig")
     */
    public function modifyAction(Request $request, $id)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('MainBundle:Contact')
            ->find($id);

        if (!$contact){
            throw $this->createNotFoundException('Contact not found');
        }


        $address=new Address();
        $address->setContact($contact);

        $form = $this->createForm(ContactType::class, $contact);

        $formAddress= $this->createForm(AddressType::class, $address,
            ['action' => $this->generateUrl('main_address_addAddress', ['id'=> $contact->getId()]),
                'method'=> 'POST']);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('main_contact_show', ['id' => $contact->getId()]);
        }

        return [
            'form' => $form->createView(),
            'formAddress' => $formAddress->createView()];
    }
        /**
        * @Route("/{id}/delete")
        * @Method("POST")
        */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $contact = $this->getDoctrine()->getRepository('MainBundle:Contact')->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found');
        }

        $em->remove($contact);

        $em->flush();

        return $this->redirectToRoute('main_contact_showall');
    }


    /**
     * @Route("/{id}")
     * @Method("GET")
     * @Template(":Contact:show.html.twig")
     */
    public function showAction($id)
    {
        $contact = $this->getDoctrine()
            ->getRepository('MainBundle:Contact')
            ->find($id);

        if(!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        return ['contact' => $contact];
    }

    /**
     * @Route("/")
     * @Template(":Contact:show_all.html.twig")
     * @Method("GET")
     */
    public function showAllAction()
    {
        $contacts=$this->getDoctrine()->getRepository('MainBundle:Contact')->findAll();


        return ['contacts' => $contacts];
    }
}