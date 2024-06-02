# AntiFall Plugin for PocketMine-MP

## Description
AntiFall is a plugin for PocketMine-MP that prevents fall damage and void damage in specified worlds. It also provides an option to teleport players to a safe location when they fall into the void.

## Features
- Disable fall damage and void damage in specified worlds.
- Option to teleport players to configurable coordinates when they fall into the void.

## Requirements
- PocketMine-MP API version: 5.0.0
- PHP 8.0 or higher

## Installation

1. **Download the Plugin**

   Download the latest release of the AntiFall plugin from the [releases page](https://github.com/NaySurGithub/AntiFall/releases).

2. **Install the Plugin**

   Place the downloaded `AntiFall.phar` file in the `plugins` directory of your PocketMine-MP server.

   ```
   ./plugins/AntiFall.phar
   ```

3. **Start the Server**

   Start or restart your PocketMine-MP server to load the AntiFall plugin.

   ```
   ./start.sh
   ```

4. **Configuration**

   After the server has started, a configuration file (`config.yml`) will be created in the `plugins/AntiFall` directory. You can edit this file to customize the plugin settings.

   ```yaml
   # config.yml example
   # Les noms des mondes où les dégâts de chute et de vide sont désactivés
   worlds:
     - "world"
     - "nether"
     - "end"
   # Si vrai, les joueurs qui tombent dans le vide seront téléportés à des coordonnées configurables
   void-tp: true
   # La coordonnée X de la téléportation
   tp-x: 0.0
   # La coordonnée Y de la téléportation
   tp-y: 64.0
   # La coordonnée Z de la téléportation
   tp-z: 0.0
   # Le nom du monde de la téléportation
   tp-world: "world"
   ```

## Usage

Once installed and configured, the plugin will automatically prevent fall damage and void damage in the specified worlds. If the void teleport option is enabled, players falling into the void will be teleported to the configured coordinates.

## Contributing

If you would like to contribute to the development of this plugin, feel free to fork the repository and submit a pull request. Contributions are welcome!

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any questions or support, you can contact the developer Nay via [GitHub](https://github.com/NaySurGithub) or via discord: naytasoeur.
