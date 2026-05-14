# Implemented commands
This page contains a list of all available client commands.

Due to differences in operation, the following ServerQuery commands are currently unsupported in WebQuery:
* `ft*` e.g. (`ftcreatedir`, `ftdeletefile`)
* `help`
* `login` and `logout`
* `quit`
* `servernotifyregister` and `servernotifyunregister`
* `use`

## version

```php
$teamspeak->servers()->version();
```

## hostinfo

```php
$teamspeak->servers()->hostInfo();
```

## instanceinfo

```php
$teamspeak->servers()->instanceInfo();
```

## instanceedit

```php
$teamspeak->servers()->editInstance(properties: ['serverinstance_filetransfer_port' => 30033]);
```

## bindinglist

```php
$teamspeak->servers()->bindingList();
```

## serverlist

```php
$teamspeak->servers()->list();
// with options:
$teamspeak->servers()->list(uid: true, all: true);
```

## serveridgetbyport

```php
$teamspeak->servers()->idGetByPort(port: 9987);
```

## serverdelete

```php
$teamspeak->servers()->delete(id: 1);
```

## servercreate

```php
$teamspeak->servers()->create(name: 'My Server');
// with additional properties:
$teamspeak->servers()->create(name: 'My Server', properties: ['virtualserver_maxclients' => 64]);
```

## serverstart

```php
$teamspeak->servers()->start(id: 1);
```

## serverstop

```php
$teamspeak->servers()->stop(id: 1);
// with reason:
$teamspeak->servers()->stop(id: 1, reasonMessage: 'Maintenance');
```

## serverprocessstop

```php
$teamspeak->servers()->stopProcess();
// with reason:
$teamspeak->servers()->stopProcess(reasonMessage: 'Shutting down');
```

## serverinfo

```php
$teamspeak->servers()->info();
```

## serverrequestconnectioninfo

```php
$teamspeak->servers()->connectionInfo();
```

## servertemppasswordadd

```php
$teamspeak->servers()->addTempPassword(password: 'secret', description: 'Guest pass', duration: 3600);
// with target channel:
$teamspeak->servers()->addTempPassword(password: 'secret', description: 'Guest pass', duration: 3600, channelId: 5, channelPassword: 'chanpw');
```

## servertemppassworddel

```php
$teamspeak->servers()->deleteTempPassword(password: 'secret');
```

## servertemppasswordlist

```php
$teamspeak->servers()->listTempPasswords();
```

## serveredit

```php
$teamspeak->servers()->edit(properties: ['virtualserver_name' => 'New Name', 'virtualserver_maxclients' => 64]);
```

## servergrouplist

```php
$teamspeak->serverGroups()->list();
```

## servergroupadd

```php
$teamspeak->serverGroups()->add(name: 'Moderators');
// also available few shortcuts:
$teamspeak->serverGroups()->addTemplate(name: 'Moderators');
$teamspeak->serverGroups()->addRegular(name: 'Moderators');
$teamspeak->serverGroups()->addQuery(name: 'Moderators');
```

## servergroupdel

```php
$teamspeak->serverGroups()->delete(id: 5);
$teamspeak->serverGroups()->delete(id: 5, force: true);
```

## servergroupcopy

```php
$teamspeak->serverGroups()->copy(id: 5, name: 'Moderators Copy'); // clone
$teamspeak->serverGroups()->copy(id: 5, target: 6); // overwrite
// also available few shortcuts:
$teamspeak->serverGroups()->clone(id: 5, name: 'Moderators Copy');
$teamspeak->serverGroups()->overwrite(from: 5, to: 6);
```

## servergrouprename

```php
$teamspeak->serverGroups()->rename(id: 5, name: 'New Name');
```

## servergrouppermlist

```php
$teamspeak->serverGroups()->getPermissions(id: 5);
$teamspeak->serverGroups()->getPermissions(id: 5, names: true);
```

## servergroupaddperm

```php
$teamspeak->serverGroups()->addPermission(serverGroupId: 5, id: 42, value: 75);
$teamspeak->serverGroups()->addPermission(serverGroupId: 5, id: 'i_group_needed_modify_power', value: 75);
$teamspeak->serverGroups()->addPermission(serverGroupId: 5, id: 42, value: 75, skip: true);
```

## servergroupdelperm

```php
$teamspeak->serverGroups()->deletePermission(serverGroupId: 5, id: 42);
$teamspeak->serverGroups()->deletePermission(serverGroupId: 5, id: 'i_group_needed_modify_power');
```

## servergroupaddclient

```php
$teamspeak->serverGroups()->addClient(id: 5, clientDatabaseId: 18);
```

## servergroupdelclient

```php
$teamspeak->serverGroups()->deleteClient(id: 5, clientDatabaseId: 18);
```

## servergroupclientlist

```php
$teamspeak->serverGroups()->getClients(id: 5);
$teamspeak->serverGroups()->getClients(id: 5, names: true);
```

## servergroupsbyclientid

```php
$teamspeak->serverGroups()->getByClient(clientDatabaseId: 18);
```

## servergroupautoaddperm

```php
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;

$teamspeak->serverGroups()->addAutoPermission(type: PermissionGroupDatabaseTypes::Regular, id: 17835, value: 75);
$teamspeak->serverGroups()->addAutoPermission(type: PermissionGroupDatabaseTypes::Regular, id: 'b_serverinstance_help_view', value: 75, negated: true, skip: true);
```

## servergroupautodelperm

```php
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;

$teamspeak->serverGroups()->deleteAutoPermission(type: PermissionGroupDatabaseTypes::Regular, id: 17835);
$teamspeak->serverGroups()->deleteAutoPermission(type: PermissionGroupDatabaseTypes::Regular, id: 'b_serverinstance_help_view');
```

## serversnapshotcreate

```php
$snapshot = $teamspeak->servers()->createSnapshot();
// $snapshot->hash — MD5 hash of the snapshot
// $snapshot->data — snapshot data to pass to deploySnapshot
```

## serversnapshotdeploy

```php
$teamspeak->servers()->deploySnapshot(snapshot: $snapshot->data);
```

## sendtextmessage

```php
use TeamSpeak\WebQuery\Enums\TextMessageTargetMode;

$teamspeak->messages()->send(TextMessageTargetMode::Client, 'Hello!', id: 12);
// also available few shortcuts:
$teamspeak->messages()->sendToClient(message: 'Hello!', id: 12);
$teamspeak->messages()->sendToChannel(message: 'Hello channel!');
$teamspeak->messages()->sendToServer(message: 'Hello server!');
```

## logview

```php
$teamspeak->logs()->list();
// with options:
$teamspeak->logs()->list(lines: 50, reverse: true, instance: true, beginPos: 100);
```

## logadd

```php
use TeamSpeak\WebQuery\Enums\LogLevel;

$teamspeak->logs()->add(LogLevel::Info, 'custom log message');
```

## gm

```php
$teamspeak->messages()->broadcast(message: 'Hello everyone!');
```

## channellist

```php
$teamspeak->channels()->list();
// with options:
$teamspeak->channels()->list(topic: true, flags: true, voice: true, limits: true, icon: true, secondsEmpty: true);
```

## channelinfo

```php
$teamspeak->channels()->info(id: 1);
```

## channelfind

```php
$teamspeak->channels()->find(pattern: 'General');
```

## channelmove

```php
$teamspeak->channels()->move(id: 5, parentId: 1);
$teamspeak->channels()->move(id: 5, parentId: 1, order: 3);
```

## channelcreate

```php
$teamspeak->channels()->create(name: 'New Channel');
$teamspeak->channels()->create(name: 'New Channel', properties: ['channel_flag_permanent' => '1']);
```

## channeldelete

```php
$teamspeak->channels()->delete(id: 5);
$teamspeak->channels()->delete(id: 5, force: true);
```

## channeledit

```php
$teamspeak->channels()->edit(id: 5, properties: ['channel_name' => 'Renamed Channel']);
```

## channelgrouplist

```php
$teamspeak->channelGroups()->list();
```

## channelgroupadd

```php
$teamspeak->channelGroups()->add(name: 'Channel Admin');
```

## channelgroupdel

```php
$teamspeak->channelGroups()->delete(id: 5);
$teamspeak->channelGroups()->delete(id: 5, force: true);
```

## channelgroupcopy

```php
$teamspeak->channelGroups()->copy(id: 5, name: 'Channel Admin Copy'); // clone
$teamspeak->channelGroups()->copy(id: 5, target: 6); // overwrite
```

## channelgrouprename

```php
$teamspeak->channelGroups()->rename(id: 5, name: 'New Name');
```

## channelgroupaddperm

```php
$teamspeak->channelGroups()->addPermission(channelGroupId: 5, id: 42, value: 75);
$teamspeak->channelGroups()->addPermission(channelGroupId: 5, id: 'i_channel_needed_join_power', value: 75);
$teamspeak->channelGroups()->addPermission(channelGroupId: 5, id: 42, value: 75, skip: true);
```

## channelgrouppermlist

```php
$teamspeak->channelGroups()->getPermissions(id: 5);
$teamspeak->channelGroups()->getPermissions(id: 5, names: true);
```

## channelgroupdelperm

```php
$teamspeak->channelGroups()->deletePermission(channelGroupId: 5, id: 42);
$teamspeak->channelGroups()->deletePermission(channelGroupId: 5, id: 'i_channel_needed_join_power');
```

## channelgroupclientlist

```php
$teamspeak->channelGroups()->getClients(id: 5);
$teamspeak->channelGroups()->getClients(id: 5, channelId: 1, clientDatabaseId: 18);
```

## setclientchannelgroup

```php
$teamspeak->channelGroups()->setClientChannelGroup(channelGroupId: 5, channelId: 1, clientDatabaseId: 18);
```

## tokenadd

Alias for `privilegekeyadd`. See [privilegekeyadd](#privilegekeyadd).

## tokendelete

Alias for `privilegekeydelete`. See [privilegekeydelete](#privilegekeydelete).

## tokenlist

Alias for `privilegekeylist`. See [privilegekeylist](#privilegekeylist).

## tokenuse

Alias for `privilegekeyuse`. See [privilegekeyuse](#privilegekeyuse).

## channelpermlist

```php
$teamspeak->channelPermissions()->list(channelId: 1);
// with permission names instead of IDs:
$teamspeak->channelPermissions()->list(channelId: 1, names: true);
```

## channeladdperm

```php
$teamspeak->channelPermissions()->add(channelId: 1, id: 42, value: 75);
$teamspeak->channelPermissions()->add(channelId: 1, id: 'i_channel_needed_join_power', value: 75, negated: true, skip: true);
```

## channeldelperm

```php
$teamspeak->channelPermissions()->delete(channelId: 1, id: 42);
$teamspeak->channelPermissions()->delete(channelId: 1, id: 'i_channel_needed_join_power');
```

## clientlist

```php
$teamspeak->clients()->list();
// with options:
$teamspeak->clients()->list(uid: true, groups: true, ip: true);
```

## clientinfo

```php
$teamspeak->clients()->info(id: 12);
```

## clientfind

```php
$teamspeak->clients()->find(pattern: 'John');
```

## clientedit

```php
$teamspeak->clients()->edit(id: 12, properties: ['client_description' => 'VIP member']);
// also available a shortcut:
$teamspeak->clients()->editDescription(id: 12, description: 'VIP member');
```

## clientdblist

```php
$teamspeak->databaseClients()->list();
// with pagination and count:
$teamspeak->databaseClients()->list(offset: 0, limit: 25, count: true);
```

## clientdbinfo

```php
$teamspeak->databaseClients()->info(databaseId: 18);
```

## clientdbfind

```php
$teamspeak->databaseClients()->find(pattern: 'John%');
$teamspeak->databaseClients()->find(pattern: 'ABC123==', uid: true);
// also available few shortcuts:
$teamspeak->databaseClients()->findByName(pattern: 'John%');
$teamspeak->databaseClients()->findByUid(pattern: 'ABC123==');
```

## clientdbedit

```php
$teamspeak->databaseClients()->edit(databaseId: 18, properties: ['client_description' => 'VIP']);
// also available a shortcut:
$teamspeak->databaseClients()->editDescription(databaseId: 18, description: 'VIP');
```

## clientdbdelete

```php
$teamspeak->databaseClients()->delete(databaseId: 18);
```

## clientgetids

```php
$teamspeak->clients()->getIds(uid: 'ABC123==');
```

## clientgetdbidfromuid

```php
$teamspeak->clients()->getDbIdFromUid(uid: 'ABC123==');
```

## clientgetnamefromuid

```php
$teamspeak->clients()->getNameFromUid(uid: 'ABC123==');
```

## clientgetuidfromclid

```php
$teamspeak->clients()->getUid(id: 12);
```

## clientgetnamefromdbid

```php
$teamspeak->clients()->getNameFromDbId(dbId: 18);
```

## clientsetserverquerylogin

```php
$teamspeak->clients()->setServerQueryLogin(loginName: 'admin');
```

## clientupdate

```php
$teamspeak->clients()->update(['client_nickname' => 'New Nick']);
// also available a shortcut:
$teamspeak->clients()->updateNickname(nickname: 'New Nick');
```

## clientmove

```php
$teamspeak->clients()->move(id: 12, channelId: 3);
$teamspeak->clients()->move(id: 12, channelId: 3, password: 'secret');
// move multiple clients at once:
$teamspeak->clients()->move(id: [12, 13, 14], channelId: 3);
```

## clientkick

```php
use TeamSpeak\WebQuery\Enums\ReasonIdentifier;

$teamspeak->clients()->kick(id: 12, type: ReasonIdentifier::KickServer);
$teamspeak->clients()->kick(id: 12, type: ReasonIdentifier::KickServer, reason: 'Rule violation');
// also available few shortcuts:
$teamspeak->clients()->kickFromChannel(id: 12);
$teamspeak->clients()->kickFromServer(id: 12, reason: 'Rule violation');
```

## clientpoke

```php
$teamspeak->clients()->poke(id: 12, message: 'Hello!');
```

## clientpermlist

```php
$teamspeak->clients()->getPermissions(databaseId: 18);
$teamspeak->clients()->getPermissions(databaseId: 18, name: true);
```

## clientaddperm

```php
$teamspeak->clients()->addPermission(databaseId: 18, id: 42, value: 75);
$teamspeak->clients()->addPermission(databaseId: 18, id: 'i_client_talk_power', value: 75);
$teamspeak->clients()->addPermission(databaseId: 18, id: 42, value: 75, skip: true);
```

## clientdelperm

```php
$teamspeak->clients()->deletePermission(databaseId: 18, id: 42);
$teamspeak->clients()->deletePermission(databaseId: 18, id: 'i_client_talk_power');
```

## channelclientpermlist

```php
$teamspeak->channelPermissions()->listForClient(channelId: 1, clientDatabaseId: 18);
// with permission names instead of IDs:
$teamspeak->channelPermissions()->listForClient(channelId: 1, clientDatabaseId: 18, names: true);
```

## channelclientaddperm

```php
$teamspeak->channelPermissions()->addForClient(channelId: 1, clientDatabaseId: 18, id: 42, value: 75);
$teamspeak->channelPermissions()->addForClient(channelId: 1, clientDatabaseId: 18, id: 'i_channel_needed_join_power', value: 75, negated: true);
```

## channelclientdelperm

```php
$teamspeak->channelPermissions()->deleteForClient(channelId: 1, clientDatabaseId: 18, id: 42);
$teamspeak->channelPermissions()->deleteForClient(channelId: 1, clientDatabaseId: 18, id: 'i_channel_needed_join_power');
```

## permissionlist

```php
$teamspeak->permissions()->list();
```

## permidgetbyname

```php
$teamspeak->permissions()->getIdByName(name: 'b_serverinstance_help_view');
```

## permoverview

```php
$teamspeak->permissions()->overview(channelId: 1, clientDatabaseId: 2);
```

## permget

```php
$teamspeak->permissions()->get(id: 17835);
$teamspeak->permissions()->get(id: 'b_serverinstance_help_view');
```

## permfind

```php
$teamspeak->permissions()->find(id: 17835);
$teamspeak->permissions()->find(id: 'b_serverinstance_help_view');
```

## permreset

```php
$teamspeak->permissions()->reset();
```

## privilegekeylist

```php
$teamspeak->privilegeKeys()->list();
```

## privilegekeyadd

```php
use TeamSpeak\WebQuery\Enums\PrivilegeKeyType;

$teamspeak->privilegeKeys()->add(type: PrivilegeKeyType::ServerGroup, id1: 6);
$teamspeak->privilegeKeys()->add(type: PrivilegeKeyType::ChannelGroup, id1: 5, id2: 3, description: 'VIP channel', customSet: 'custom');
// also available shortcuts:
$teamspeak->privilegeKeys()->addServerGroup(serverGroupId: 6);
$teamspeak->privilegeKeys()->addChannelGroup(channelGroupId: 5, channelId: 3);
```

## privilegekeydelete

```php
$teamspeak->privilegeKeys()->delete(token: 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
```

## privilegekeyuse

```php
$teamspeak->privilegeKeys()->redeem(token: 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
```

## messagelist

```php
$teamspeak->messages()->listInbox();
```

## messageadd

```php
$teamspeak->messages()->sendInbox(uniqueIdentifier: 'ABC123==', subject: 'Hello', message: 'How are you?');
```

## messagedel

```php
$teamspeak->messages()->deleteInbox(id: 42);
```

## messageget

```php
$teamspeak->messages()->getInbox(id: 42);
```

## messageupdateflag

```php
$teamspeak->messages()->updateFlagInbox(id: 42, flag: true);
// also available few shortcuts:
$teamspeak->messages()->markAsReadInbox(id: 42);
$teamspeak->messages()->markAsUnreadInbox(id: 42);
```

## complainlist

```php
$teamspeak->complaints()->list();
// filter by target client:
$teamspeak->complaints()->list(targetClientDatabaseId: 5);
```

## complainadd

```php
$teamspeak->complaints()->add(targetClientDatabaseId: 5, message: 'bad behavior');
```

## complaindelall

```php
$teamspeak->complaints()->deleteAll(targetClientDatabaseId: 5);
```

## complaindel

```php
$teamspeak->complaints()->delete(targetClientDatabaseId: 5, fromClientDatabaseId: 3);
```

## banclient

```php
$teamspeak->bans()->client(id: 12);
$teamspeak->bans()->client(id: 12, seconds: 3600, reason: 'Spam');
```

## banlist

```php
$teamspeak->bans()->list();
```

## banadd

```php
$teamspeak->bans()->add(ipAddressRegexp: '127.0.0.*');
$teamspeak->bans()->add(nameRegexp: 'baduser%', reason: 'Spam', seconds: 86400);
$teamspeak->bans()->add(uniqueIdentifier: 'ABC123==');
```

## bandel

```php
$teamspeak->bans()->delete(id: 5);
```

## bandelall

```php
$teamspeak->bans()->deleteAll();
```

## customsearch

```php
$teamspeak->customProperties()->search(ident: 'forum_id', pattern: '12345');
```

## custominfo

```php
$teamspeak->customProperties()->info(clientDatabaseId: 18);
```

## whoami

```php
$teamspeak->whoami();
```
