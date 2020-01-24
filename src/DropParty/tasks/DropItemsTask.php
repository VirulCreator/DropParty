<?php

namespace DropParty\tasks;

use DropParty\Main;
use pocketmine\item\Item;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class DropItemsTask extends Task{

    /** @var int */
    private $time = 30; //30 sec
    /** @var DropPartyTask */
    private $partyTask;
    /** @var bool */
    private $sentStartedMessage = false;

    public function __construct(int $time, DropPartyTask $partyTask){
        $this->time = $time;
        $this->partyTask = $partyTask;
    }

    public function onRun(int $currentTick): void{
        if($this->time <= 0){
            $ended = Main::get()->getCfg()["messages"]["ended"];
            Server::getInstance()->broadcastMessage($ended);
            Main::get()->getScheduler()->cancelTask(self::getTaskId());
            $this->partyTask->reset();
        }else{
            $this->dropItems();
            $this->time--;
        }
    }

    public function dropItems(): void{
        $started = Main::get()->getCfg()["messages"]["started"];
        $level = Main::get()->getCfg()["level"];
        $popupEnable = Main::get()->getCfg()["popup"]["enabled"];
        $popup = Main::get()->getCfg()["popup"]["message"];

        if(!$this->sentStartedMessage) Server::getInstance()->broadcastMessage($started);

        $lvl = Server::getInstance()->getLevelByName($level);
        foreach(Server::getInstance()->getOnlinePlayers() as $p){
            if($popupEnable and !$this->sentStartedMessage) $p->sendPopup($popup);
            if($lvl !== null){
                $lvl->dropItem(Main::get()->getLocation(), Main::get()->getRandomItem());
            }else{
                Server::getInstance()->getLogger()->warning("Items cannot be drop since the world is not loaded or wrong name");
            }
        }
        $this->sentStartedMessage = true;
    }
}