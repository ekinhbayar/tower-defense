var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Map = (function() {
    'use strict';

    function Map() {

    }

    Map.prototype.draw = function(canvasContext, canvas) {
        this.drawBackground(canvasContext, canvas);
    };

    Map.prototype.drawBackground = function(canvasContext, canvas) {
        canvasContext.fillStyle = 'black';
        canvasContext.fillRect(0, 0, canvas.width, canvas.height);
    };

    return Map;
}());
