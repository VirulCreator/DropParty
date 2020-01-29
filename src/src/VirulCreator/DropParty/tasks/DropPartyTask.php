<?php

namespace VirulCreator\DropParty\tasks;

use VirulCreator\DropParty\Main;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class DropPartyTask extends Task{

    /** @var int */
    private $time = 60; //1 min
    /** @var int */
    private $status = 1; //status

    public function __construct(){
        $this->reset();
    }

    public function onRun(int $currentTick): void{
        if($this->status === 0) return;
        $this->checkStartingMessage();

        if($this->time <= 0){
            $duration = Main::get()->getCfg()["duration"];
            Main::get()->getScheduler()->scheduleRepeatingTask(new DropItemsTask($duration, $this), 20);
            $this->status = 0;
        }else{
            $this->time--;
        }
    }

    public function checkStartingMessage(): void{
        $times = Main::get()->getCfg()["times"];
        $messages = Main::get()->getCfg()["messages"];

        //starting message
        if(in_array($this->time, $times)){
            if($this->time >= 60){
                $time = floor(($this->time / 60) % 60) . " minutes";
            }else{
                $time = $this->time . " seconds";
            }
            $message = str_replace("{time}", $time, $messages["starting"]);
            Server::getInstance()->broadcastMessage($message);
        }
    }

    public function dropItems(): void{
        $started = Main::get()->getCfg()["messages"]["started"];
        $level = Main::get()->getCfg()["level"];
        $popupEnable = Main::get()->getCfg()["popup"]["enabled"];
        $popup = Main::get()->getCfg()["popup"]["message"];

        Server::getInstance()->broadcastMessage($started);

        $lvl = Server::getInstance()->getLevelByName($level);
        foreach(Server::getInstance()->getOnlinePlayers() as $p){
            if($popupEnable) $p->sendPopup($popup);
            if($lvl !== null){
                $lvl->dropItem(Main::get()->getLocation(), Main::get()->getRandomItem());
            }else{
                Server::getInstance()->getLogger()->warning("Items cannot be drop since the world is not loaded or wrong name");
            }
        }
    }

    public function reset(): void{
        $this->time = Main::get()->getCfg()["time"];
        $this->status = 1;
    }
}