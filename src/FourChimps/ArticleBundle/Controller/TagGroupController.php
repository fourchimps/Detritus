<?php

namespace FourChimps\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FourChimps\ArticleBundle\Entity\TagGroup;
use FourChimps\ArticleBundle\Form\TagGroupType;

/**
 * TagGroup controller.
 *
 * @Route("/taggroup")
 */
class TagGroupController extends Controller
{
    /**
     * Lists all TagGroup entities.
     *
     * @Route("/", name="taggroup")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FourChimpsArticleBundle:TagGroup')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Navigable TagGroup entities.
     *
     * @Route("/sidebar", name="sidebar")
     */
    public function sidebarAction($current=false)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FourChimpsArticleBundle:TagGroup')->findByNavigable(true);

        return $this->render(
            'FourChimpsArticleBundle:TagGroup:_sidebar.html.twig',
            array(
                'entities' => $entities,
                'current' => $current,
            )
        );
    }

    /**
     * Lists all Tags in a TagGroup .
     *
     * @Route("{id}/tags", name="tags")
     */
    public function tagsAction($id, $current=false)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:TagGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TagGroup entity.');
        }

        return $this->render(
            'FourChimpsArticleBundle:TagGroup:_nav.html.twig',
            array(
                'entities' => $entity->getTags(),
                'current' => $current,
            )
        );
    }


    /**
     * Finds and displays a TagGroup entity.
     *
     * @Route("/{id}/show", name="taggroup_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:TagGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TagGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new TagGroup entity.
     *
     * @Route("/new", name="taggroup_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TagGroup();
        $form   = $this->createForm(new TagGroupType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new TagGroup entity.
     *
     * @Route("/create", name="taggroup_create")
     * @Method("POST")
     * @Template("FourChimpsArticleBundle:TagGroup:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new TagGroup();
        $form = $this->createForm(new TagGroupType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taggroup_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TagGroup entity.
     *
     * @Route("/{id}/edit", name="taggroup_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:TagGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TagGroup entity.');
        }

        $editForm = $this->createForm(new TagGroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TagGroup entity.
     *
     * @Route("/{id}/update", name="taggroup_update")
     * @Method("POST")
     * @Template("FourChimpsArticleBundle:TagGroup:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:TagGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TagGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TagGroupType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taggroup_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TagGroup entity.
     *
     * @Route("/{id}/delete", name="taggroup_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FourChimpsArticleBundle:TagGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TagGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('taggroup'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
