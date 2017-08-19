export default [
	{
		label: 'Dashboard',
		icon: 'dashboard',
		uri: '/home'
	},
	{
		label: 'Usuários',
		icon: 'account_circle',
		uri: "/users"
	},
	{
		label: 'Contas',
		icon: 'attach_money',
		dropdown: true,
		subMenus: [
			{	
				label: 'Geral',
				uri: "/contas/geral"
			}
		]
	},
	{
		label: 'Configurações',
		icon: 'tal',
		uri: "/configs"
	}
]