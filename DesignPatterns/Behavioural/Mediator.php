<?php
    namespace DesignPatterns\Behavioural\Mediator;

    interface Mediator {
        public function notify(Component $component, string $event);
    }


    class WebPage implements Mediator {
        public function notify(Component $component, string $event) {

        }
    }

    abstract class Component {
        protected Mediator $parent;

        public function __construct(Mediator $parent) {
            $this->parent = $parent;
        }

        public function click(): void {
            $this->parent->notify($this, "click");
        }
    }

    class Button extends Component {
        private string $text;

        public function getText(): string
        {
            return $this->text;
        }

        public function setText(string $text): void
        {
            $this->text = $text;
        }
    }