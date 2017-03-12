var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Map = (function(exports) {
    'use strict';

    function Map(map) {
        this.paths = [];

        map.path.forEach((path) => {
            this.paths.push(new exports.TowerDefense.UserInterface.Path(path.x, path.y));
        });

        this.spawn = new exports.TowerDefense.UserInterface.Spawn(map.spawn.x, map.spawn.y);

        this.players = [];

        map.players.forEach((player) => {
            this.players.push(new exports.TowerDefense.UserInterface.Player(map.player, player));
        });

        this.enemy = new exports.TowerDefense.UserInterface.Enemy(map.spawn.x + 10, map.spawn.y - 5);
    }

    Map.prototype.draw = function(scale, canvasContext, canvas) {
        this.drawBackground(canvasContext, canvas);
        this.drawPath(scale, canvasContext);
        this.drawPlayers(scale, canvasContext, canvas);

        this.enemy.draw(scale, canvasContext);

        this.spawn.draw(scale, canvasContext, canvas);
    };

    Map.prototype.drawBackground = function(canvasContext, canvas) {
        canvasContext.fillStyle = 'black';
        canvasContext.fillRect(0, 0, canvas.width, canvas.height);
    };

    Map.prototype.drawPath = function(scale, canvasContext) {
        this.paths.forEach((path) => {
            path.draw(scale, canvasContext);
        });
    };

    Map.prototype.drawPlayers = function(scale, canvasContext, canvas) {
        this.players.forEach((player) => {
            player.draw(scale, canvasContext, canvas);
        });
    };

    return Map;
}(window));
