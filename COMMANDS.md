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

Not implemented.

## hostinfo

Not implemented.

## instanceinfo

Not implemented.

## instanceedit

Not implemented.

## bindinglist

Not implemented.

## serverlist

Not implemented.

## serveridgetbyport

Not implemented.

## serverdelete

Not implemented.

## servercreate

Not implemented.

## serverstart

Not implemented.

## serverstop

Not implemented.

## serverprocessstop

Not implemented.

## serverinfo

Not implemented.

## serverrequestconnectioninfo

Not implemented.

## servertemppasswordadd

Not implemented.

## servertemppassworddel

Not implemented.

## servertemppasswordlist

Not implemented.

## serveredit

Not implemented.

## servergrouplist

Not implemented.

## servergroupadd

Not implemented.

## servergroupdel

Not implemented.

## servergroupcopy

Not implemented.

## servergrouprename

Not implemented.

## servergrouppermlist

Not implemented.

## servergroupaddperm

Not implemented.

## servergroupdelperm

Not implemented.

## servergroupaddclient

Not implemented.

## servergroupdelclient

Not implemented.

## servergroupclientlist

Not implemented.

## servergroupsbyclientid

Not implemented.

## servergroupautoaddperm

Not implemented.

## servergroupautodelperm

Not implemented.

## serversnapshotcreate

Not implemented.

## serversnapshotdeploy

Not implemented.

## sendtextmessage

```php
$teamspeak->messages()->send();
// also available few shortcuts:
$teamspeak->messages()->sendToClient();
$teamspeak->messages()->sendToChannel();
$teamspeak->messages()->sendToServer();
```

## logview

Not implemented.

## logadd

Not implemented.

## gm

```php
$teamspeak->messages()->broadcast();
```

## channellist

```php
$teamspeak->channels()->list();
```

## channelinfo

```php
$teamspeak->channels()->info();
```

## channelfind

```php
$teamspeak->channels()->find();
```

## channelmove

```php
$teamspeak->channels()->move();
```

## channelcreate

```php
$teamspeak->channels()->create();
```

## channeldelete

```php
$teamspeak->channels()->delete();
```

## channeledit

```php
$teamspeak->channels()->edit();
```

## channelgrouplist

Not implemented.

## channelgroupadd

Not implemented.

## channelgroupdel

Not implemented.

## channelgroupcopy

Not implemented.

## channelgrouprename

Not implemented.

## channelgroupaddperm

Not implemented.

## channelgrouppermlist

Not implemented.

## channelgroupdelperm

Not implemented.

## channelgroupclientlist

Not implemented.

## setclientchannelgroup

Not implemented.

## tokenadd

Not implemented.

## tokendelete

Not implemented.

## tokenlist

Not implemented.

## tokenuse

Not implemented.

## channelpermlist

Not implemented.

## channeladdperm

Not implemented.

## channeldelperm

Not implemented.

## clientlist

```php
$teamspeak->clients()->list();
```

## clientinfo

```php
$teamspeak->clients()->info();
```

## clientfind

```php
$teamspeak->clients()->find();
```

## clientedit

```php
$teamspeak->clients()->edit();
// also available a shortcut:
$teamspeak->clients()->editDescription();
```

## clientdblist

```php
$teamspeak->databaseClients()->list();
```

## clientdbinfo

```php
$teamspeak->databaseClients()->info();
```

## clientdbfind

```php
$teamspeak->databaseClients()->find();
// also available few shortcuts:
$teamspeak->databaseClients()->findByName();
$teamspeak->databaseClients()->findByUid();
```

## clientdbedit

```php
$teamspeak->databaseClients()->edit();
// also available a shortcut:
$teamspeak->databaseClients()->editDescription();
```

## clientdbdelete

```php
$teamspeak->databaseClients()->delete();
```

## clientgetids

```php
$teamspeak->clients()->getIds();
```

## clientgetdbidfromuid

```php
$teamspeak->clients()->getDbIdFromUid();
```

## clientgetnamefromuid

```php
$teamspeak->clients()->getNameFromUid();
```

## clientgetuidfromclid

```php
$teamspeak->clients()->getUid();
```

## clientgetnamefromdbid

```php
$teamspeak->clients()->getNameFromDbId();
```

## clientsetserverquerylogin

```php
$teamspeak->clients()->setServerQueryLogin();
```

## clientupdate

```php
$teamspeak->clients()->update();
// also available a shortcut:
$teamspeak->clients()->updateNickname();
```

## clientmove

```php
$teamspeak->clients()->move();
```

## clientkick

```php
$teamspeak->clients()->kick();
// also available few shortcuts:
$teamspeak->clients()->kickFromChannel();
$teamspeak->clients()->kickFromServer();
```

## clientpoke

```php
$teamspeak->clients()->poke();
```

## clientpermlist

```php
$teamspeak->clients()->getPermissions();
```

## clientaddperm

```php
$teamspeak->clients()->addPermission();
```

## clientdelperm

```php
$teamspeak->clients()->deletePermission();
```

## channelclientpermlist

Not implemented.

## channelclientaddperm

Not implemented.

## channelclientdelperm

Not implemented.

## permissionlist

Not implemented.

## permidgetbyname

Not implemented.

## permoverview

Not implemented.

## permget

Not implemented.

## permfind

Not implemented.

## permreset

Not implemented.

## privilegekeylist

Not implemented.

## privilegekeyadd

Not implemented.

## privilegekeydelete

Not implemented.

## privilegekeyuse

Not implemented.

## messagelist

```php
$teamspeak->messages()->listInbox();
```

## messageadd

```php
$teamspeak->messages()->sendInbox();
```

## messagedel

```php
$teamspeak->messages()->deleteInbox();
```

## messageget

```php
$teamspeak->messages()->getInbox();
```

## messageupdateflag

```php
$teamspeak->messages()->updateFlagInbox();
// also available few shortcuts:
$teamspeak->messages()->markAsReadInbox();
$teamspeak->messages()->markAsUnreadInbox();
```

## complainlist

Not implemented.

## complainadd

Not implemented.

## complaindelall

Not implemented.

## complaindel

Not implemented.

## banclient

```php
$teamspeak->bans()->client();
```

## banlist

```php
$teamspeak->bans()->list();
```

## banadd

```php
$teamspeak->bans()->add();
```

## bandel

```php
$teamspeak->bans()->delete();
```

## bandelall

```php
$teamspeak->bans()->deleteAll();
```

## customsearch

Not implemented.

## custominfo

Not implemented.

## whoami

Not implemented.

