<?php

namespace FourChimps\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FourChimps\ArticleBundle\Entity\Article;
use FourChimps\ArticleBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/")
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     * @Route("", name="article")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FourChimpsArticleBundle:Article')->findPublishedMostRecent(6);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * All articles that are tagged with a specific tag, using a template fragment
     *
     * @Route("article/{tagName}/{templateFragment}/partial_tag", name="partial_tag")
     */
    public function partialTagAction($tagName, $templateFragment)
    {
        $tag = $this->getDoctrine()
            ->getManager()
            ->getRepository('FourChimpsArticleBundle:Tag')
            ->findOneByTag($tagName);

        if (!$tag) {
            throw $this->createNotFoundException('No tag found for tag '.$tagName);
        }

        // Calculate the template name
        $templateName = 'FourChimpsArticleBundle:Article:' . $templateFragment . '.html.twig';

        return $this->render($templateName, array('entities' => $tag->getArticles()));
    }

    /**
     * All articles that are marked a Hero
     *
     * @Route("article/hero", name="_hero")
     * @Template()
     */
    public function _heroAction()
    {
        $entities = $this->getDoctrine()
            ->getManager()
            ->getRepository('FourChimpsArticleBundle:Article')
            ->findPublishedHero();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * All articles that are marked a Section
     *
     * @Route("article/sections", name="_sections")
     * @Template()
     */
    public function _sectionsAction()
    {
        $entities = $this->getDoctrine()
            ->getManager()
            ->getRepository('FourChimpsArticleBundle:Article')
            ->findPublishedSections();

        return array(
            'entities' => $entities,
        );
    }


    /**
     * All articles that are tagged with a specific tag
     *
     * @Route("article/{tagName}/tag", name="article_tag")
     * @Template()
     */
    public function tagAction($tagName)
    {
        $tag = $this->getDoctrine()
            ->getManager()
            ->getRepository('FourChimpsArticleBundle:Tag')
            ->findOneByTag($tagName);

        if (!$tag) {
            throw $this->createNotFoundException('No tag found for tag '.$tagName);
        }

        return array(
            'entities' => $tag->getArticles(),
            'tag' => $tag,
        )
            ;
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("article/{id}/show", name="article_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Route("article/new", name="article_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Article();
        $form   = $this->createForm(new ArticleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("article/create", name="article_create")
     * @Method("POST")
     * @Template("FourChimpsArticleBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Article();
        $form = $this->createForm(new ArticleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("article/{id}/edit", name="article_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createForm(
            new ArticleType(
                $this->container->get('router')->generate(
                    'tag_data'
                )
            ),
            $entity
        );
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Article entity.
     *
     * @Route("article/{id}/update", name="article_update")
     * @Method("POST")
     * @Template("FourChimpsArticleBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entityRepository = $em->getRepository('FourChimpsArticleBundle:Article');
        $entity = $entityRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(
            new ArticleType(
                $this->container->get('router')->generate(
                    'tag_data'
                )
            ),
            $entity
        );

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);

            $entityRepository->persistTagsFromJSONBuffer($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("article/{id}/delete", name="article_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FourChimpsArticleBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
