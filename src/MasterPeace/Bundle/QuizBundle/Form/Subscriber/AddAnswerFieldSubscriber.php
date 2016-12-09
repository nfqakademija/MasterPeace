<?php

namespace MasterPeace\Bundle\QuizBundle\Form\Subscriber;

use MasterPeace\Bundle\QuizBundle\Entity\Question;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
use MasterPeace\Bundle\QuizBundle\Form\AnswerChoiceType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddAnswerFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_SET_DATA => 'postSetData');
    }

    public function postSetData(FormEvent $event)
    {
        /** @var QuizResultAnswer $data */
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $form->add('answer', AnswerChoiceType::class, [
            'choices' => $this->getAnswerChoices($data->getQuestion()),
            'label' => $data->getQuestion()->getTitle(),
        ]);
    }

    private function getAnswerChoices(Question $question)
    {
        $choices = [];
        foreach ($question->getAnswers() as $answer) {
            $choices[$answer->getTitle()] = $answer->getId();
        }

        return $choices;
    }
}
