<?php

namespace App\Factory;

use App\Entity\Event;

class EventSportFactoryHandler implements EventFactoryHandlerInterface
{

	public function createEvent(): Event
	{
		return new Event(); // <- It's just an exemple, you do return a new event with one eventPlanningSport associated
	}

	public static function support(string $type): bool
	{
		return 'sport' === $type;
	}
}
