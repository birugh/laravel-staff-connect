<!DOCTYPE html>
<html>

<body>
    <main>
        <div style="padding-left:96px; padding-right:96px; margin-left:auto; margin-right:auto;">
            <div style="height:100vh; display:flex; align-items:center;">
                <div style="width:100%; max-width:480px; background:white; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); margin-left:auto; margin-right:auto; overflow:hidden;">
                    <div style="background:#2563eb; width:100%; height:120px;">
                        <div style="height:100%; display:flex; align-items:center; justify-content:center; gap:12px;">
                            <svg style="height:100%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path fill="#ffffff" d="M160 96C124.7 96 96 124.7 96 160L96 480C96 515.3 124.7 544 160 544L480 544C515.3 544 544 515.3 544 480L544 160C544 124.7 515.3 96 480 96L160 96zM305.1 331.9L204.4 271.4C196.7 266.8 192 258.5 192 249.5C192 235.4 203.4 224 217.5 224L422.4 224C436.5 224 447.9 235.4 447.9 249.5C447.9 258.5 443.2 266.8 435.5 271.4L334.9 331.9C330.4 334.6 325.3 336 320 336C314.7 336 309.6 334.6 305.1 331.9zM448 301.3L448 384C448 401.7 433.7 416 416 416L224 416C206.3 416 192 401.7 192 384L192 301.3L288.7 359.3C298.1 365 309 368 320 368C331 368 341.9 365 351.3 359.3L448 301.3z" />
                            </svg>

                            <h2 style="color:white; font-weight:500; font-size:24px; margin:0;">Staff Connect</h2>
                        </div>
                    </div>
                    <div style="padding:48px;">
                        <h2 style="font-weight:500; font-size:24px; word-wrap:break-word; overflow-wrap:break-word; margin-bottom:16px;">
                            {{ $subject }}
                        </h2>
                        <p style="font-weight:500; color:#3b82f6; word-wrap:break-word; overflow-wrap:break-word; margin-bottom:8px;">
                            To: {{ $receiverEmail }}
                        </p>
                        <p style="width:100%; font-size:16px; word-wrap:break-word; overflow-wrap:break-word; margin: 0;">
                            {!! $body !!}
                        </p>
                        <p style="margin-top:24px; font-size:12px; color:#666;">
                            Email ini dikirim otomatis oleh sistem.
                        </p>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>