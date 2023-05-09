<?php

namespace App\Factory;

use App\Entity\Event;

interface EventFactoryHandlerInterface
{
	public function createEvent(): Event;
	public static function support(string $type): bool;
}
