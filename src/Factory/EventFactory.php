<?php

namespace App\Factory;

use App\Entity\Event;

class EventFactory
{
	public function __construct(private iterable $eventFactoryHandlers)
	{}

	public function create(string $type): Event
	{

		foreach ($this->eventFactoryHandlers as $eventFactoryHandler) {
			if ($eventFactoryHandler::support($type))
			{
				return $eventFactoryHandler->createEvent();
			}
		}

		throw new \InvalidArgumentException('Invalid type');
	}

}
