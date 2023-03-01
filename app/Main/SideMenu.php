<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview'
                    ],
                ]
            ],
            // 'components' => [
            //     'icon' => 'inbox',
            //     'title' => 'Components',
            //     'sub_menu' => [
            //         'grid' => [
            //             'icon' => '',
            //             'title' => 'Grid',
            //             'sub_menu' => [
            //                 'regular-table' => [
            //                     'icon' => '',
            //                     'route_name' => 'regular-table',
            //                     'params' => [
            //                         'layout' => 'side-menu'
            //                     ],
            //                     'title' => 'Regular Table'
            //                 ],
            //                 'tabulator' => [
            //                     'icon' => '',
            //                     'route_name' => 'tabulator',
            //                     'params' => [
            //                         'layout' => 'side-menu'
            //                     ],
            //                     'title' => 'Tabulator'
            //                 ]
            //             ]
            //         ]
            //     ]
            // ],

        ];
    }
}
