(function(exports) {
    const map = {
        spawn: {
            x: 400,
            y: 0
        },
        player: {
            id: 1,
            token: 'ewiy4734y7ed'
        },
        players: [
            {
                id: 1,
                name: 'PeeHaa',
                x: 600,
                y: 0
            },
            {
                id: 2,
                name: 'Ekin',
                x: 0,
                y: 200
            },
            {
                id: 3,
                name: 'Word',
                x: 0,
                y: 340
            },
            {
                id: 4,
                name: 'Excel',
                x: 890,
                y: 0
            }
        ]
    };

    new exports.TowerDefense.Engine(map, new exports.TowerDefense.Video.Canvas()).start();
}(window));
