import Dexie, { type Table } from 'dexie';
import { syncAddon } from './syncAddon';
export interface User {
	id?: number;
	name: string;
	email: string;
}

export interface syncTable {
	id?: number;
	command: string;
}
export class SubDexie extends Dexie {
	users!: Table<User>;
	constructor() {
		super('quickq');

		this.version(1).stores({
			users: 'id++, name, email'
		});

		this.use(syncAddon(this, { syncTableName: 'syncTable', whiteList: ['users'] }));
	}
}
export const db = new SubDexie();
