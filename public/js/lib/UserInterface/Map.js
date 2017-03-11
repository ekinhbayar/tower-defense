var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Map = (function(exports) {
    'use strict';

    function Map(map) {
        this.spawn = new exports.TowerDefense.UserInterface.Spawn(map.spawn.x, map.spawn.y);

        this.players = [];

        map.players.forEach((player) => {
            this.players.push(new exports.TowerDefense.UserInterface.Player(map.player, player));
        });
    }

    Map.prototype.draw = function(canvasContext, canvas) {
        this.drawBackground(canvasContext, canvas);
        this.drawPlayers(canvasContext, canvas);

        this.spawn.draw(canvasContext, canvas);
    };

    Map.prototype.drawBackground = function(canvasContext, canvas) {
        canvasContext.fillStyle = 'black';
        canvasContext.fillRect(0, 0, canvas.width, canvas.height);
    };

    Map.prototype.drawPlayers = function(canvasContext, canvas) {
        this.players.forEach((player) => {
            player.draw(canvasContext, canvas);
        });
    };

    return Map;
}(window));
