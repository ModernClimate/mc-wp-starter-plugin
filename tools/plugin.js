import { Command } from 'commander';

import { changePluginVersion } from './version.js';

const program = new Command();

program
  .version('0.0.1')
  .option('-tv, --plugin-version [pluginVersion]', 'new plugin version')
  .parse(process.argv);

const options = program.opts();

console.log(options);

if (options.pluginVersion) {
  console.log('Updating plugin version to:', options.pluginVersion);
  changePluginVersion(options.pluginVersion);
}
