import plugin from '../plugin.json'
const alert = acode.require('alert')

class AcodePlugin {
	async init() {
		const handleOnHide = () => {
			window.toast('Alert modal closed', 4000)
		}

		alert('Title of Alert', 'The alert body message..', handleOnHide)
	}

	async destroy() {}
}

if (window.acode) {
	const acodePlugin = new AcodePlugin()
	acode.setPluginInit(
		plugin.id,
		async (baseUrl, $page, { cacheFileUrl, cacheFile }) => {
			if (!baseUrl.endsWith('/')) {
				baseUrl += '/'
			}
			acodePlugin.baseUrl = baseUrl
			await acodePlugin.init($page, cacheFile, cacheFileUrl)
		}
	)
	acode.setPluginUnmount(plugin.id, () => {
		acodePlugin.destroy()
	})
}
