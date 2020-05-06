<?php
declare(strict_types=1);

/**
 * Created by YLL Co Inc.
 * User: NiZerin
 * Email: nzl199851@163.com
 * Blog: nizer.in
 * Date: 4/30/2020
 * Time: 5:26 PM
 * FileName: Controller.php
 */


namespace Src\WebSocket;

use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;

class Controller implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    public function onMessage(WebSocketServer $server, Frame $frame): void
    {
        $server->push($frame->fd, 'Recv: ' . $frame->data);
    }
    
    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }
    
    public function onOpen(WebSocketServer $server, Request $request): void
    {
        $server->push($request->fd, 'Opened: '. $request->fd);
    }
}