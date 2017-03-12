var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Fps = (function() {
    'use strict';

    function Fps(fpsCounter) {
        this.fpsCounter = fpsCounter;
    }

    Fps.prototype.draw = function(scale, canvasContext) {
        canvasContext.font      = '24px Interface';
        canvasContext.fillStyle = 'white';

        //noinspection JSCheckFunctionSignatures
        canvasContext.fillText(Math.round(this.fpsCounter.get()) + ' fps', 10, 35);
    };

    return Fps;
}());
