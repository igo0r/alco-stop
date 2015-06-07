<?php

namespace AlcoStop\Bundle\UserBundle\Admin;

use AlcoStop\Bundle\UserBundle\Entity\User;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Security\Core\Security;

class UserAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('plainPassword', 'password')
            ->add('alcoLevelId', null, ['required' => true])
            ->add(
                'dateOfBirth',
                'sonata_type_date_picker',
                [
                    'datepicker_use_button' => false,
                    'dp_default_date'       => '01-01-2000',
                    'required'              => true,
                    'dp_use_current'        => true,
                    'format'                => 'dd-MM-yyyy',
                    'dp_show_today'         => true
                ]
            )
            ->add('gender', 'choice', ['choices' => User::getGenderList()]);
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
            ->add('username');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('firstname')
            ->add('lastname')
            ->add('username')
            ->add(
                '_action',
                'input',
                [
                    'actions' => [
                        'show'   => [],
                        'edit'   => [],
                        'delete' => [],
                    ]
                ]
            );
    }

    /* public function createQuery($context = 'list')
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
     }*/

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
