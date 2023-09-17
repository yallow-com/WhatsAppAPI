# WhatsAppAPI
### How to install

1. in *composer.json* add:

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/yallow-com/WhatsAppAPI.git"
    }
]
```

2. run:

```
composer require yallow-com/whatsapp-api:dev-main
```

3. in *.env* add:

```
WHATSAPP_BASE_URL=
WHATSAPP_API_VER=
WHATSAPP_PHONE_NUMBER_ID=
WHATSAPP_PERMANENT_ACCESS_TOKEN=
```
### Examples
```
$wp_client = new YallowCom\WhatsAppAPI\WhatsAppAPI();
$res = $wp_client->send('+xxxxxxxxxxxx', 'text', 'this is a test from package');
$res = $wp_client->send('+xxxxxxxxxxxx', 'template', 'hello_world');
$res = $wp_client->send('+xxxxxxxxxxxx', 'buttons', 'this is the body', 'header',[['id'=>'xyx', 'title' => 'First btn'], ['id'=>'xyxz', 'title' => 'Sec. btn']]);
$res = $wp_client->send('+xxxxxxxxxxxx', 
                        'lists', 
                        'header text', 
                        'body text', 
                        'footer text',
                        'button text',
                        [
                            ['title' => 'First optios', 'options' => [
                                    ['id'=>'xyx', 'title' => 'First btn', 'description' => 'desc 1'],
                                    ['id'=>'xyxz', 'title' => 'Sec. btn', 'description' => 'desc 2']
                                ]
                            ]
                        ]);
```
