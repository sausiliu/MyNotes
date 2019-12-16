# Q&A

## echart

* 坐标lable竖着显示

```javascript
xAxis: {
      axisLabel:{
          interval:0,
          formatter:function(value) {
              return value.split("").join("\n");
           }
      }
}
```

* 坐标lable倾斜角度

```javascript
xAxis: {
      axisLabel:{
          interval:0,
          rotate:30
      }
}
```
