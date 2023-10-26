### terminal command
1. ``cd ..`` to access back to the Freetime Project directory
2. ``mkdir event-emitter`` to create the folder
3. ``cd event-emitter`` to access to that directory
4. ``code .`` to open this folder on VScode
5. set up NPM again ``npm init``
6. `` npm install --save-dev @babel/core @babel/cli @babel/preset-env @babel/node `` install babel to transplier older version
- Create file `.babelrc`
- Add setting to support ES6 version (just add this to `.babelrc` file) 
```
{
    "presets": ["@babel/preset-env"]
}
```
7. This program will run on `dist/main.js` when tpye `npm run build` % `npm run start` because we changed script section in `package.json` to be
```
 "scripts": {
    "start": "node dist/main.js",
    "build": "babel src --out-dir dist"
  }
``` 
8. type `ctrl c` in terminal to stop interval function that keep sending data every timeout

**description**
The 'events' module is not typically found in the 'node_modules' folder because it's a core module provided by Node.js itself. Core modules are built-in and are available as part of the Node.js runtime, so you don't need to install them separately, and they are not stored in the 'node_modules' directory.

You can import the 'events' module directly in your Node.js application without specifying a path, like this:

```javascript
import EventEmitter from 'events';
```

Node.js will automatically provide the 'events' module for you, and you don't need to locate it in the 'node_modules' folder because it's not installed as an external package. It's part of the Node.js runtime, so it's always available when you run Node.js applications.