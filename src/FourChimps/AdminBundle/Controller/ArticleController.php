<?php

namespace FourChimps\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FourChimps\ArticleBundle\Entity\Article;
use FourChimps\AdminBundle\Form\ArticleType;
use Doctrine\ORM\QueryBuilder;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     * @Route("/", name="admin_article")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $columns = $em->getRepository('FourChimpsArticleBundle:Article')->getDataTableDefinition();

        return array(
            'columns' => $columns,
        );
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}/show", name="admin_article_show")
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
     * @Route("/new", name="admin_article_new")
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
     * @Route("/create", name="admin_article_create")
     * @Method("POST")
     * @Template("FourChimpsAdminBundle:Article:new.html.twig")
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

            return $this->redirect($this->generateUrl('admin_article_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="admin_article_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);
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
     * @Route("/{id}/update", name="admin_article_update")
     * @Method("POST")
     * @Template("FourChimpsAdminBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FourChimpsArticleBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ArticleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_article_edit', array('id' => $id)));
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
     * @Route("/{id}/delete", name="admin_article_delete")
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

        return $this->redirect($this->generateUrl('admin_article'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Driver for jQuery DataTable
     *
     * @Route("/list_data/{$request}", name="list_articles")
     * @param Request $request
     *
     * @return Response
     */
    public function listDataAction(Request $request) {

        $repository = $this->getDoctrine()->getRepository('FourChimpsArticleBundle:Article');
        $columns = $repository->getDataTableDefinition();

        /* paging */
        $length = $request->query->get('iDisplayLength');
        $start = $request->query->get('iDisplayStart');

        /* column sorting */
        $sorts = array();
        if ($request->query->get('iSortCol_0') || $request->query->get('iSortCol_0') === '0') {
            for ( $i=0 ; $i < intval( $request->query->get('iSortingCols') ) ; $i++ ) {
                if ( $request->query->get('bSortable_' . intval($request->query->get('iSortCol_'.$i))) == "true" ) {
                    $sorts[] = (object) array(
                        'column' => $columns[$request->query->get('iSortCol_'.$i)],
                        'direction' => $request->query->get('sSortDir_'.$i)
                    );
                }
            }
        }

        /* global filtering */
        $globalFilter = $request->query->get('sSearch');

        /* Individual column filtering */
        $columnFilters = array();
        for ( $i=0 ; $i<count($columns) ; $i++ ) {
            if ( $request->query->get('bSearchable_'.$i)  == "true" && $request->query->get('sSearch_'.$i) != '') {
                $columnFilters[] = (object) array(
                    'column' => $columns[$i],
                    'filter' => $request->query->get('sSearch_'.$i)
                );
            }
        }

        $list = $repository->getPagedSortedFilteredArticles($start, $length, $sorts, $columns, $globalFilter, $columnFilters);
        $aaData = array();
        foreach ($list as $article) {
            $row = array();
            for ( $i=0 ; $i<count($columns) ; $i++ ) {
                $expressionGenerator = $columns[$i]->getSelectBy();
                $row[$i] = $expressionGenerator($article);
            }
            $aaData[]=$row;
        }

        $totalRecords = $repository->getFilteredArticlesCount($columns, $globalFilter, $columnFilters);

        $output = array(
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "sEcho"=>$request->query->get('sEcho'),
            "aaData" => $aaData,
        );

        return  new Response(json_encode($output));
    }

}
