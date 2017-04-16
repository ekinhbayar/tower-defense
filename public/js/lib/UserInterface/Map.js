var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Map = (function(exports) {
    'use strict';

    function Map(map) {
        this.paths = [];

        this.loaded = false;

        this.numberLoaded = 0;

        this.tiles = [
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image(),
            new Image()
        ];

        for (let i = 0; i < this.tiles.length; i++) {
            this.tiles[i].addEventListener('load', () => {
                this.numberLoaded++;

                if (this.numberLoaded === this.tiles.length) {
                    this.loaded = true;
                }
            });
        }

        this.tiles[0].src = 'img/bg1.png';
        this.tiles[1].src = 'img/bg1.png';
        this.tiles[2].src = 'img/bg1.png';
        this.tiles[3].src = 'img/bg1.png';
        this.tiles[4].src = 'img/bg1.png';
        this.tiles[5].src = 'img/bg1.png';
        this.tiles[6].src = 'img/bg1.png';
        this.tiles[7].src = 'img/bg1.png';
        this.tiles[8].src = 'img/bg1.png';
        this.tiles[9].src = 'img/bg1.png';
        this.tiles[10].src = 'img/bg2.png';
        this.tiles[11].src = 'img/bg2.png';
        this.tiles[12].src = 'img/bg2.png';
        this.tiles[13].src = 'img/bg2.png';
        this.tiles[14].src = 'img/bg2.png';
        this.tiles[15].src = 'img/bg2.png';
        this.tiles[16].src = 'img/bg2.png';
        this.tiles[17].src = 'img/bg2.png';
        this.tiles[18].src = 'img/bg3.png';
        this.tiles[19].src = 'img/bg3.png';
        this.tiles[20].src = 'img/bg3.png';
        this.tiles[21].src = 'img/bg3.png';
        this.tiles[22].src = 'img/bg3.png';
        this.tiles[23].src = 'img/bg3.png';

        map.path.forEach((path) => {
            this.paths.push(new exports.TowerDefense.UserInterface.Path(path.x, path.y));
        });

        this.spawn = new exports.TowerDefense.UserInterface.Spawn(map.spawn.x, map.spawn.y);

        this.players = [];

        map.players.forEach((player) => {
            this.players.push(new exports.TowerDefense.UserInterface.Player(map.player, player));
        });

        this.enemy = new exports.TowerDefense.UserInterface.Enemy(map.spawn.x + 10, map.spawn.y - 5);

        this.backgroundTiles = [];
    }

    Map.prototype.draw = function(canvas) {
        this.drawBackground(canvas);
        this.drawPath(canvas);
        this.drawPlayers(canvas);

        this.enemy.draw(canvas);

        this.spawn.draw(canvas);
    };

    Map.prototype.generateBackgroundTiles = function(canvas) {
        if (!this.loaded) {
            return;
        }

        for (let x = 0; x < (1200 / 20); x++) {
            for (let y = 0; y < (800 / 20); y++) {
                let randomTile = Math.floor(Math.random() * (23 - 0 + 1)) + 0;

                this.backgroundTiles.push({
                    tile: this.tiles[randomTile],
                    dx: ((x * 20) + canvas.x) * canvas.scale.x,
                    dy: ((y * 20) + canvas.y) * canvas.scale.y,
                    dWidth: 20 * canvas.scale.x,
                    dHeight: 20 * canvas.scale.y
                });
            }
        }
    };

    Map.prototype.drawBackground = function(canvas) {
        if (!this.loaded) {
            return;
        }

        if (!this.backgroundTiles.length) {
            this.generateBackgroundTiles(canvas);
        }

        for (let i = 0; i < this.backgroundTiles.length; i++) {
            canvas.context.drawImage(this.backgroundTiles[i].tile, this.backgroundTiles[i].dx, this.backgroundTiles[i].dy, this.backgroundTiles[i].dWidth, this.backgroundTiles[i].dHeight);
        }
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
