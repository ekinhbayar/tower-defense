var TowerDefense = TowerDefense || {};
TowerDefense.UserInterface = TowerDefense.UserInterface || {};

TowerDefense.UserInterface.Fps = (function() {
    'use strict';

    function Fps(fpsCounter) {
        this.fpsCounter = fpsCounter;
    }

    Fps.prototype.draw = function(canvas) {
        canvas.context.font      = '24px Interface';
        canvas.context.fillStyle = 'white';

        //noinspection JSCheckFunctionSignatures
        canvas.context.fillText(Math.round(this.fpsCounter.get()) + ' fps', 10, 35);
    };

    return Fps;
}());
