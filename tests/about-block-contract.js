const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');

const root = path.resolve(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');
const metadata = JSON.parse(read('blocks/about/block.json'));
const editor = read('blocks/about/editor.js');
const files = [
    'blocks/about/block.json',
    'blocks/about/editor.js',
    'blocks/about/render.php',
    'assets/css/components/cph-about.css'
];

assert.equal(metadata.name, 'cph/about');
assert.match(editor, /var blockName = 'cph\/about';/);
assert.match(read('functions.php'), /\/blocks\/about'/);
assert.ok(fs.existsSync(path.join(root, 'assets/images/cph/cph-about-rhodes.webp')));

files.forEach((file) => {
    assert.doesNotMatch(read(file), /[—–]/u, `${file} contains a forbidden dash character`);
});

console.log('About block contract passed.');
