# symfony-messages-api

Simple REST API in a modular monolith architecture written in PHP 8.3 and Symfony 7.0 and using the MongoDB database. It has the functionality of sending a message to a person.

## Features

* PHP 8.3
* Laravel Symfony 7.0
* CommandBus, QueryBus, EventBus, SharedEventBus, SharedQueryBus
* CQRS and Event-driven programming
* API documentation provided by Swagger
* MongoDB ODM configured and MongoDbMiddleware for Messenger
* CORS configured by NelmioCorsBundle
* Modules - each module has separate config, routing, Doctrine mapping etc.

## Examples of use

* [CreatePersonHandler](./src/Module/Person/Application/Interaction/Command/CreatePerson/Handler/CreatePersonHandler.php)
* [RemovePersonHandle](./src/Module/Person/Application/Interaction/Command/RemovePerson/Handler/RemovePersonHandler.php)
* [UpdatePersonHandler](./src/Module/Person/Application/Interaction/Command/UpdatePerson/Handler/UpdatePersonHandler.php)
* [AskForPersonFilteredListHandler](./src/Module/Person/Application/Interaction/Query/AskForPersonFilteredList/Handler/AskForPersonFilteredListHandler.php)
* [AskForPersonPaginatedListHandler](./src/Module/Person/Application/Interaction/Query/AskForPersonPaginatedList/Handler/AskForPersonPaginatedListHandler.php)
* [FindSpecifiedPersonsHandler](./src/Module/Person/Application/Interaction/Query/FindSpecifiedPersons/Handler/FindSpecifiedPersonsHandler.php)
* [PersonFilterBuilder](./src/Module/Person/Application/Filter/PersonFilter/PersonFilterBuilder.php)
* [Person/UI/Controller/Person](./src/Module/Person/UI/Controller/Person)
* [CreateMessageHandler](./src/Module/Message/Application/Interaction/Command/CreateMessage/Handler/CreateMessageHandler.php)
* [RemoveMessageHandler](./src/Module/Message/Application/Interaction/Command/RemoveMessage/Handler/RemoveMessageHandler.php)
* [UpdateMessageHandler](./src/Module/Message/Application/Interaction/Command/UpdateMessage/Handler/UpdateMessageHandler.php)
* [DispatchSharedEventHandler](./src/Module/Message/Application/Interaction/Event/MessageCreated/Handler/DispatchSharedEventHandler.php)
* [AskForMessagePaginatedHandler](./src/Module/Message/Application/Interaction/Query/AskForMessagePaginatedList/Handler/AskForMessagePaginatedHandler.php)
* [FindPersonCollectionHandler](./src/Module/Message/Application/Interaction/Query/FindPersonCollection/Handler/FindPersonCollectionHandler.php)
* [MessageFilterBuilder](./src/Module/Message/Application/Filter/MessageFilter/MessageFilterBuilder.php)
* [Message/UI/Controller](./src/Module/Message/UI/Controller)

## Copyrights

Copyright © Rafał Mikołajun 2024.
