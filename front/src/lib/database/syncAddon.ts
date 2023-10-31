import type { Middleware, DBCore } from 'dexie';
import type Dexie from 'dexie';
interface syncOptions {
	syncTableName: string;
	whiteList: string[];
}

//https://github.com/dexie/Dexie.js/blob/1ed96685dbb71639655cfdcf82f7670554538174/addons/dexie-cloud/src/middlewares/createMutationTrackingMiddleware.ts
export function syncAddon(db: Dexie, opts: syncOptions): Middleware<DBCore> {
	return {
		stack: 'dbcore',

		create: (core) => {
			return {
				...core,

				table: (tableName) => {
					const table = core.table(tableName);

					return {
						...table
					};
					/* console.dir(core);
				
					if (opts.whiteList.includes(tableName)) {
						console.log(core);
					}
					return downTable; */
				}
			};
		}
	};
}

export function syncMiddleware(options?: { db: Dexie; options: syncOptions }) {
	console.log('Loaded');
}
