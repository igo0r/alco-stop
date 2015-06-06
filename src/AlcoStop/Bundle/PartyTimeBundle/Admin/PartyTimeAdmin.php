<?php

namespace AlcoStop\Bundle\PartyTimeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Security\Core\Security;

class PartyTimeAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Post Title'))
            ->add('author', 'entity', array('class' => 'Acme\DemoBundle\Entity\User'))
            ->add('body') //if no type is specified, SonataAdminBundle tries to guess it
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('author');
    }

    public function createQuery($context = 'list')
    {
        $queryBuilder = $this->getModelManager()->getEntityManager($this->getClass())->createQueryBuilder();

        //if is logged admin, show all data
        if ($this->securityContext->isGranted('ROLE_ADMIN')) {
            $queryBuilder->select('p')
                ->from($this->getClass(), 'p')
            ;
        } else {
            //for other users, show only data, which belongs to them
            $adminId = $this->securityContext->getToken()->getUser()->getAdminId();

            $queryBuilder->select('p')
                ->from($this->getClass(), 'p')
                ->where('p.adminId=:adminId')
                ->setParameter('adminId', $adminId, Type::INTEGER)
            ;
        }

        $proxyQuery = new ProxyQuery($queryBuilder);
        return $proxyQuery;
    }

    /**
     * Security Context
     * @var Security
     */
    protected $securityContext;

    public function setSecurityContext(Security $securityContext)
    {
        $this->securityContext = $securityContext;
    }
}
