<?php
$sourceSections = '[{
  "id": 1,
  "uuid": "c398d8aa-4b16-4a30-8586-4416299fb55d",
  "type": "section",
  "title": "Пользователи",
  "path": null,
  "parent": null,
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}, {
  "id": 4,
  "uuid": "b627f7fd-95a4-4830-a897-60740d20a730",
  "type": "section",
  "title": "Тестовый раздел",
  "path": null,
  "parent": null,
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}]';
$sourceSubsections = '[{
  "id": 5,
  "uuid": "bd6b64cd-ae02-4cbb-b65c-ab1b34cbffd0",
  "type": "subsection",
  "title": "Тестовый подраздел",
  "path": "test-subsection",
  "parent": "b627f7fd-95a4-4830-a897-60740d20a730",
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}]';
$sourceItems = '[{
  "id": 2,
  "uuid": "c9469495-a8d3-4df2-ad9c-d962a7ebb8b7",
  "type": "item",
  "title": "Пользователи",
  "path": "user",
  "parent": "c398d8aa-4b16-4a30-8586-4416299fb55d",
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}, {
  "id": 3,
  "uuid": "c9469495-a8d3-4df2-ad9c-d962a7ebb8b7",
  "type": "item",
  "title": "Администраторы",
  "path": "administrator",
  "parent": "c398d8aa-4b16-4a30-8586-4416299fb55d",
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}, {
  "id": 6,
  "uuid": "944a9071-5fff-42a1-8c85-3d39a7b7cb08",
  "type": "item",
  "title": "Тестовый пункт 1",
  "path": "test-item-1",
  "parent": "bd6b64cd-ae02-4cbb-b65c-ab1b34cbffd0",
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}, {
  "id": 7,
  "uuid": "d423c1ff-d414-4487-973f-7ab2bf255378",
  "type": "item",
  "title": "Тестовый пункт 2",
  "path": "test-item-2",
  "parent": "bd6b64cd-ae02-4cbb-b65c-ab1b34cbffd0",
  "role": [
    "ROLE_ADMIN"
  ],
  "createdAt": {
    "date": "2020-04-19 08:44:03.000000",
    "timezone_type": 3,
    "timezone": "Europe/Moscow"
  },
  "updatedAt": null,
  "deletedAt": null
}]';

function filterNodes(string $uuid): object
{
  return function($item) use ($uuid)
  {

    return $item->{'parent'} == $uuid;
  };
}

$sections = json_decode($sourceSections);
$subsections = json_decode($sourceSubsections);
$items = json_decode($sourceItems);

$navigation = array_map(function ($section) use ($subsections, $items): object
  {
    $uuid = $section->{'uuid'};
    $nodes = array_filter($items, filterNodes($uuid));
    $children = array_map(function ($node): object
    {
      return (object) array(
        'name' => $node->{'title'},
        'url' => $node->{'path'},
      );
    }, $nodes);

    return (object) array(
      'name' => $section->{'title'},
      'children' => $children,
    );
  }, $sections
);

var_dump($navigation);

echo PHP_EOL, PHP_EOL, 'Terminate?';
$terminateHandler = fopen ('php://stdin','r');
$terminateResponse = fgets($terminateHandler);
exit;
fclose($terminateHandler);
