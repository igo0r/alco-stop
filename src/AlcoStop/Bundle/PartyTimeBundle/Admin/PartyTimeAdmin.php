<?php

namespace AlcoStop\Bundle\PartyTimeBundle\Admin;

use AlcoStop\Bundle\PartyTimeBundle\Service\PartyTimeService;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PartyTimeAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        //var_dump();die;
        /** @var AuthorizationChecker $token */
        $authChecker = $this->get('security.authorization_checker');
        var_dump($authChecker->isGranted('EDIT', $formMapper->getAdmin()->getSubject()));die;
        if ($authChecker->isGranted('EDIT', $formMapper->getAdmin()->getSubject())) {
            throw new AccessDeniedException;
        }

        $formMapper
            ->add(
                'drinkId',
                'sonata_type_model',
                [
                    'class'        => 'DrinkBundle:Drink',
                    'multiple'     => false,
                    'by_reference' => false,
                    'label'        => 'Drinks',
                    'btn_add'      => false
                ]
            )
            ->add(
                'userId',
                'sonata_type_model',
                [
                    'class'   => 'AlcoStop\Bundle\UserBundle\Entity\User',
                    'btn_add' => false,
                    'label'   => 'User name'
                ]
            )
            ->add('volume', null, ['required' => true])
            ->add(
                'issueDate',
                'sonata_type_date_picker',
                [
                    'datepicker_use_button' => false,
                    'required'              => true,
                    'dp_use_current'        => true,
                    'format'                => 'dd-MM-yyyy',
                    'dp_show_today'         => true
                ]
            );
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('drinkId')
            ->add('userId');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('userId', null, ['label' => 'User names'])
            ->add('drinkId', null, ['label' => 'Drinks'])
            ->add('volume', null, ['label' => 'Volume (Liters)'])
            ->add('issueDate', null, ['label' => 'Party date', 'format' => 'd-M-y',])
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

    public function createQuery($context = 'list')
    {
        /** @var PartyTimeService $partyTimeService */
        $partyTimeService = $this->get('alco_stop.service.party_time');
        $proxyQuery       = new ProxyQuery($partyTimeService->getActivitiesListQuery());

        return $proxyQuery;
    }

    /**
     * Get a service
     *
     * @param string $id The service ID
     *
     * @return object The associated service
     */
    public function get($id)
    {
        return $this->getConfigurationPool()->getContainer()->get($id);
    }
}
