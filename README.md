# DropParty
Drop Party is a simple, easy to use plugin that lets you create drop parties on your server.

## Overview
Drop Party allows you to define an area at which a Drop Party will occur. Once a drop party starts (either automatically or manually) a countdown from 10 minute will take place, this gives players few minute to teleport to the Drop Party location. Once the countdown is over, the plugin will start dropping random items above them!

>- The automatic drop party feature isn't fully tested, let me know if it doesn't work!
>- The minimum players limit only applies to automatic drop parties, not manually started ones.

[![](https://poggit.pmmp.io/shield.state/DropParty)](https://poggit.pmmp.io/p/DropParty)
<a href="https://poggit.pmmp.io/p/DropParty"><img src="https://poggit.pmmp.io/shield.state/DropParty"></a>

![DropParty](https://github.com/VirulCreator/DropParty/blob/master/media/dropparty.png)

---
## Feature
>- Set chests that items will be taken from for chest parties
>- Set item spawn points for each drop party
>- Set firework spawn points for each drop party, where fireworks will be shot at the end of the party
>- Set each drop party's item drop delay, maximum length, and maximum stack size
>- Set each drop party's firework spawn delay and amount. Fireworks will spawn at the end of a Drop Party
>- Enable vote to start on a drop party, and set the required amount of votes to start it
>- Enable votifier for a party and let players vote through votifier (currently disabled in v3.2)
>- Enable periodic start on a drop party, and set the length of time between each automatic start
>- Set a party to not empty a chest, so the party can be run repeatedly without refilling chests.
>- Announces when drop parties are started/stopped
>- Let players teleport to drop parties
>- All messages are configurable and can be easily changed
---

## Setting up the plugin:

* Place the plugin into the plugins folder of your server.
* Restart or reload the server to load the plugin and generate a configuration file in /plugins_data/dropparty.
* Edit the messages and default party settings. (OPTIONAL)
* Reload the plugin with /reload

## Download
 [PoggitCI](https://poggit.pmmp.io) < ComingSoon

---
## Config
```yaml
---
level: "world"
coordinates: "261,68,227"
items: ["1:2", 42, 22, 41]
duration: 30 #How long is it going on for
time: 60 #in seconds
times: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 60] #what time do u want countdown to annouce it

messages:
  started: "§a[§6Drop§bParty§a] §dHas started! Do /spawn to get the items at the §5DropParty"
  ended: "§a[§6Drop§bParty§a] §dHas ended! Good game all."
  starting: "§a[§6Drop§bParty§a] §dis starting in §5{time}."
popup:
  enabled: true
  message: "§a[§6Drop§bParty§a] §dItems are dropping! §5Do /spawn to get those items!"
...
```
---

## The License
Drop Party is licensed under the GNU General Public License v3.0 0 

### TOS:
* You may not upload, distribute or share this plugin with anyone else but yourself, if they have asked for the plugin, link the resource.
* You may not redistribute source code, any part of it or decompile it
* I am not obligated to make updates to this resource, but I'll keep on adding features.
* I may not add feature you request, don't go raging about it.
* I am allowed to report and get reviews that are low rating deleted, if the reporter hasn't contacted me before with his problem.

## This Project is on poggit

