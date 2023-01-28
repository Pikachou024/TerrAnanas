export class LoadPageScript
{
    constructor() {
        this.pageScripts = {
            '/': './page1.js',
            '/page1': './page1.js',
            '/page2': './page2.js',
            '/page3': './page3.js'
        };
    }

    loadScript() {
        const currentPath = window.location.pathname;
        const scriptUrl = this.pageScripts[currentPath];
        if (scriptUrl) {
            const script = document.createElement('script');
            script.src = scriptUrl;
            document.body.appendChild(script);
        }
    }

}