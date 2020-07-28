package com.lab4.demo.controller;

import com.lab4.demo.model.GreetingResponse;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import java.io.FileOutputStream;
import java.util.concurrent.atomic.AtomicLong;

@RestController
public class HelloController {
    private final AtomicLong counter = new AtomicLong();

    @RequestMapping("/hello")
    public String hello() {
        return "/test";
    }

    @CrossOrigin(origins="*")
    @RequestMapping("/greeting")
    public GreetingResponse greeting(@RequestParam(value = "name",defaultValue = "world") String name){
        return new GreetingResponse(counter.incrementAndGet(),"Hello, "+name+"!");
    }

    @CrossOrigin(origins="*")
    @RequestMapping(value = "/write", method = RequestMethod.POST)
    public String write(int p_id,String fileStorageName){
        String File_BASE = "/www/wwwroot/www.zhsyy.top/SuperNova/UploadFile/";

        try {
            java.io.File targetFile = new java.io.File(File_BASE+p_id+"/", fileStorageName);
            if(!targetFile.getParentFile().exists()){ //注意，判断父级路径是否存在
                targetFile.getParentFile().mkdirs();
            }
            System.out.println("dir:");
            System.out.println(File_BASE+p_id+"/");
            System.out.println("filename:");
            System.out.println(fileStorageName);

            targetFile.setWritable(true, false);
            //保存
            FileOutputStream fos = new FileOutputStream(targetFile);
            fos.write(fileStorageName.getBytes());
            fos.close();
            return "写文件成功";
        } catch (Exception e) {
            System.out.println("上传文件异常");
            System.out.println(e.toString());
            return "写文件失败";
        }
    }
}
