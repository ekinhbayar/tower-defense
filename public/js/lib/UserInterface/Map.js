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

    Map.prototype.draw = function(canvas) {
        this.drawBackground(canvas);
        this.drawPath(canvas);
        this.drawPlayers(canvas);

        this.enemy.draw(canvas);

        this.spawn.draw(canvas);
    };

    Map.prototype.drawBackground = function(canvas) {
        canvas.context.fillStyle = 'black';
        canvas.context.fillRect(0, 0, canvas.element.width, canvas.element.height);
    };

    Map.prototype.drawPath = function(canvas) {
        this.paths.forEach((path) => {
            path.draw(canvas);
        });
    };

    Map.prototype.drawPlayers = function(canvas) {
        this.players.forEach((player) => {
            player.draw(canvas);
        });
    };

    return Map;
}(window));
