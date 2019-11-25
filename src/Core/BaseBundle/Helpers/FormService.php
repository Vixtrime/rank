<?php

namespace App\Core\BaseBundle\Helpers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class FormService
 * @package App\Frontend\ServiceBundle
 */
class FormService
{
//    private $translator;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactoryInterface, TranslatorInterface $translator)
    {
//        $this->translator = $translator;
        $this->formFactory = $formFactoryInterface;
    }

    /**
     * @param string $formType
     * @param $entity
     * @return FormInterface
     */
    public function createForm(string $formType, $entity = null): FormInterface
    {
        return $this->formFactory->create($formType, $entity);
    }

    public function getFormToken(FormInterface $form)
    {
        $formOptions = $form->getConfig()->getOptions();
        if ($formOptions['csrf_protection']) {
            return [
                $formOptions['csrf_field_name'] =>
                    $formOptions['csrf_token_manager']->getToken($formOptions['csrf_token_id'])->getValue(),
            ];
        }
        return [];
    }

    /**
     * @param FormInterface $form
     * @param array $default
     * @return array
     */
    public function getFormFields(FormInterface $form, array $default = [])
    {
        $jsonAttrs = [];
        $token = $this->getFormToken($form);
        if ($token) {
            $jsonAttrs = array_merge($jsonAttrs, $token);
        }
        foreach ($form->all() as $field) {
//            dd($field->getConfig()->getAttributes()['choice_list']);
            if (array_key_exists($field->getName(), $default)) {
                $jsonAttrs[$field->getName()] = $default[$field->getName()];
            } else {
                $jsonAttrs[$field->getName()] = $field->getNormData();
            }
        }

//        die;
        if (!empty($jsonAttrs['errors'])) {
            $jsonAttrs['errors'] = $form->getErrors();
        }
        return $jsonAttrs;
    }

    /**
     * @param FormInterface $form
     * @return array
     */
    public function getFormErrors(FormInterface $form)
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            if (!array_key_exists('formErrors', $errors)) {
                $errors['formErrors'] = [];
            }
            array_push($errors['formErrors'], $error->getMessage());
        }
        foreach ($form->all() as $field) {
            foreach ($field->getErrors() as $error) {
                if (!array_key_exists('fieldErrors', $errors)) {
                    $errors['fieldErrors'] = [];
                }
                if (!array_key_exists($field->getName(), $errors['fieldErrors'])) {
                    $errors['fieldErrors'][$field->getName()] = [];
                }
                array_push($errors['fieldErrors'][$field->getName()], $error->getMessage());
            }
        }
        return $errors;
    }

//    /**
//     * @param array $formErrors
//     * @param $errors
//     * @return array
//     */
//    public function setFormErrors(array $formErrors, $errors)
//    {
//        if (!array_key_exists('formErrors', $formErrors)) {
//            $formErrors['formErrors'] = [];
//        }
//        if (is_array($errors)) {
//            foreach ($errors as $key => $value) {
//                $errors[$key] = $this->translator->trans($value);
//            }
//            $formErrors['formErrors'] = array_merge($formErrors['formErrors'], $errors);
//        } else {
//            $formErrors['formErrors'][] = $this->translator->trans($errors);
//        }
//        return $formErrors;
//    }
//
//    /**
//     * @param array $formErrors
//     * @param $errors
//     * @return array
//     */
//    public function setFormFieldErrors(array $formErrors, $errors)
//    {
//        if (!array_key_exists('fieldErrors', $formErrors)) {
//            $formErrors['fieldErrors'] = [];
//        }
//        foreach ($errors as $errorName => $errorValue) {
//            if (!array_key_exists($errorName, $formErrors['fieldErrors'])) {
//                $formErrors['fieldErrors'][$errorName] = [];
//            }
//            if (is_array($errorValue)) {
//                foreach ($errorValue as $key => $value) {
//                    $errorValue[$key] = $this->translator->trans($value);
//                }
//                $formErrors['fieldErrors'][$errorName] = array_merge($formErrors['fieldErrors'][$errorName], $errorValue);
//            } else {
//                $formErrors['fieldErrors'][$errorName][] = $this->translator->trans($errorValue);
//            }
//        }
//        return $formErrors;
//    }
}
