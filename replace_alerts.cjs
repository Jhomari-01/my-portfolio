const fs = require('fs');
let file = fs.readFileSync('resources/js/components/AdminDashboard.vue', 'utf8');

file = file.replace(/alert\('([^']+)'\);/g, (match, p1) => {
    let type = p1.toLowerCase().includes('fail') || p1.toLowerCase().includes('error') || p1.toLowerCase().includes('match') ? 'error' : 'success';
    return `showToast('${type === 'error' ? 'Error' : 'Success'}', '${p1}', '${type}');`;
});

file = file.replace(/alert\(`([^`]+)`\);/g, (match, p1) => {
    let type = p1.toLowerCase().includes('fail') || p1.toLowerCase().includes('error') || p1.toLowerCase().includes('match') ? 'error' : 'success';
    return `showToast('${type === 'error' ? 'Error' : 'Success'}', \`${p1}\`, '${type}');`;
});

file = file.replace(/alert\(message\);/g, `showToast('Error', message, 'error');`);

fs.writeFileSync('resources/js/components/AdminDashboard.vue', file);
console.log('Replaced alerts successfully.');
