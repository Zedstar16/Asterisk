<?php

declare(strict_types=1);

namespace Zedstar16\Asterisk;

use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener {

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function CommandEvent(CommandEvent $event){
	    $p = $event->getSender();
	    $cmd = $event->getCommand();
	    if($event->isCancelled()){
	        return;
        }
	    if(strpos($cmd, " * ") !== false){
	        if($p->hasPermission("asterisk")){
	            $event->setCancelled();
	            foreach($this->getServer()->getOnlinePlayers() as $player){
	                $pn = $player->getName();
	                str_replace("*", "\"".$pn."\"", $cmd);
	                $this->getServer()->dispatchCommand($p, $cmd);
                }
            }
        }
    }

}
