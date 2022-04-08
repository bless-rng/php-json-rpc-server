# JSON-RCP server for php
## Overview

Simple json-rpc server for process incoming messages with you own method realization and response message serialization.

Fully compliant with the JSON-RPC 2.0 specifications.

## How to use
1. Create methods anywhere extended by AbstractMethod with some included realization(you can override params validation method if you need).
2. Create MethodResolver with inject array of your method 
   
   ```$resolver = new MethodResolver([new MethodA(), new MethodB()]);```
3. Create server and inject MethodResolverInterface 
   
   ```$server = new Server($resolver);```
4. Configure you nginx or router for routing to method 
    
   `````$server->resolve(string $requestContent);`````

Requirements
PHP >= 8.0

## Author
Telegram: [Maks Vesnin](https://t.me/maks_vesnin)