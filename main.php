<?php
$sourceMenu = '[{
  "id": 1,
  "uuid": "c398d8aa-4b16-4a30-8586-4416299fb55d",
  "type": "section",
  "title": "Пользователи",
  "path": null,
  "parent": "root",
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
  "parent": "root",
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
}, {
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
  "uuid": "d99a4ed0-e5e5-4f0a-9659-4f297aaa8f88",
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

$data = json_decode($sourceMenu);

function createTree($data)
{
  $parents = [];
  foreach ($data as $key => $item) {
    $parents[$item->{'parent'}][$item->{'uuid'}] = $item;
  }

  $treeNode = $parents['root'];
  createNode($treeNode, $parents);

  return $treeNode;
}

function createNode(&$treeNode, $parents)
{
  foreach ($treeNode as $key => $item) {
    if (!isset($item->children)) {
      $treeNode[$key]->children = [];
    }

    if (array_key_exists($key, $parents)) {
      $treeNode[$key]->children = $parents[$key];
      createNode($treeNode[$key]->children, $parents);
    }
  }
}

$tree = createTree($data);

var_dump(json_encode(array_values($tree)));

echo PHP_EOL, PHP_EOL, 'Terminate?';
$terminateHandler = fopen ('php://stdin','r');
$terminateResponse = fgets($terminateHandler);
exit;
fclose($terminateHandler);