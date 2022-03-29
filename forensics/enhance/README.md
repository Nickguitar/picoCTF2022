![](/Screenshots/Pasted%20image%2020220329181302.png)

`strings drawing.flag.svg  | egrep "tspan...." | sed -E "s/.*>([^<]+).*/\1/g" | tr -d '\n| '`

![](/Screenshots/Pasted%20image%2020220329181319.png)
