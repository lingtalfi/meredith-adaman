<?php


use Meredith\ContentTransformer\ActiveInactiveContentTransformer;
use Meredith\ContentTransformer\UpdateDeleteMenuContentTransformer;
use Meredith\FormCommunicationHelper\FrenchBootstrapFormCommunicationHelper;
use Meredith\FormDataProcessor\FormDataProcessor;
use Meredith\FormHandler\FormHandler;
use Meredith\FormRenderer\AuthorFormRenderer;
use Meredith\FormRenderer\ControlsRenderer\BootstrapControlsRenderer;
use Meredith\FormRenderer\ControlsRenderer\Control\InputControl;
use Meredith\FormRenderer\ControlsRenderer\Control\MonoStatusControl;
use Meredith\ListHandler\AuthorListHandler;
use Meredith\MainController\AuthorMainController;
use Meredith\OnModalOpenAfter\OnModalOpenAfter;
use Meredith\Supervisor\MeredithSupervisor;
use Meredith\ValidationCodeHandler\JqueryValidationCodeHandler;
use Meredith\ValidatorJsUserCode\ValidatorJsUserCode;


$mainController = AuthorMainController::create()
    ->setFormId(MeredithSupervisor::inst()->getFormId())
    ->setListHandler(AuthorListHandler::create()
            ->addColumn('id')
            ->addColumn('email')
            ->addColumn('pass')
            ->addColumn('rib')
            ->addColumn('active')
            ->addColumn('actions', false)
            ->setContentTransformer('actions', UpdateDeleteMenuContentTransformer::create())
            ->setContentTransformer('active', ActiveInactiveContentTransformer::create())
            ->setOnModalOpenAfter(OnModalOpenAfter::create()->setDir(APP_DIR . "/pages/meredith/on-modal-open-after"))
    )
    ->setFormHandler(FormHandler::create()
            ->setFormCommunicationHelper(FrenchBootstrapFormCommunicationHelper::create())
            ->setFormRenderer(AuthorFormRenderer::create()
                    ->setDir(APP_DIR . "/pages/meredith/form-controls")
                    ->setControlsRenderer(BootstrapControlsRenderer::create()
                            ->addControl(InputControl::create()->setName("email")->setLabel("Email")->setType("email")->setPlaceHolder("Enter a valid email address"))
                            ->addControl(InputControl::create()->setName("pass")->setLabel("Mot de passe")->setType("password")->setPlaceHolder("Enter at least 5 characters"))
                            ->addControl(InputControl::create()->setName("repeat_password")->setLabel("Confirm password")->setType("password")->setPlaceHolder("Enter the password again"))
                            ->addControl(InputControl::create()->setName("rib")->setLabel("Rib")->setPlaceHolder("Enter your rib")->setHelp("99999 - 99999 - *********** - 99"))
                            ->addControl(MonoStatusControl::create()->setName("active")->setLabel("Active"))
                    )
            )
            ->setValidationCodeHandler(JqueryValidationCodeHandler::create()
                    ->setValidatorJsUserCode(ValidatorJsUserCode::create()
                            ->setDir(APP_DIR . "/pages/meredith/validator-user-code")
                    )
            )
    )
    ->setFormDataProcessor(FormDataProcessor::create()
            ->addField('id', true, true)
            ->addField('email', false, false)
            ->addField('pass', false, false)
            ->addField('rib', false, false)
            ->addField('active', false, false, 0)
    );