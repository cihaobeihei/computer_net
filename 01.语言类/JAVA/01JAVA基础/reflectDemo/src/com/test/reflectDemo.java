package com.test;

import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.lang.reflect.Method;
import java.util.Properties;

import org.junit.Test;

import com.noble.BeanConf;

public class reflectDemo {
	

	public BeanConf getMsg() throws Exception {
		BeanConf beanConf = new BeanConf();
		
		Properties propClass = new Properties();
		propClass.load(new InputStreamReader(new FileInputStream("bean.conf")));
		
		beanConf.setClassName(propClass.getProperty("className"));
		beanConf.setId(propClass.getProperty("id"));
		
		Properties propData = new Properties();
		propData.load(new InputStreamReader(new FileInputStream("data.conf")));
		
		for(String name : propData.stringPropertyNames()) {
			String value = propData.getProperty(name);
			beanConf.getProps().setProperty(name, value);
		}
		//System.out.println(beanConf);
		
		return beanConf;
	}
	
	@Test
	public void demo01() throws Exception {
		BeanConf beanConf = getMsg();
		
		Class clazz = Class.forName(beanConf.getClassName());
		Object obj = clazz.newInstance();
		
		for(String name : beanConf.getProps().stringPropertyNames()) {
			String value = beanConf.getProps().getProperty(name);
			//System.out.println(name + ":" + value);
			String methodName = "set" + name.substring(0, 1).toUpperCase() + name.substring(1);
			//System.out.println(methodName);
			Method method = clazz.getMethod(methodName, String.class);
			method.invoke(obj, value);
		}
		
		System.out.println(obj);
	}
	
	
	public static void main(String[] args) throws Exception {
		reflectDemo a = new reflectDemo();
		a.getMsg();
	}
}
