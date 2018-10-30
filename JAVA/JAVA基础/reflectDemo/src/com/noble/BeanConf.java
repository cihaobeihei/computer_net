package com.noble;

import java.util.Properties;

public class BeanConf {
	private String className;
	private String id;
	
	private Properties props = new Properties();

	/**
	 * @return the className
	 */
	public String getClassName() {
		return className;
	}

	/**
	 * @param className the className to set
	 */
	public void setClassName(String className) {
		this.className = className;
	}

	/**
	 * @return the id
	 */
	public String getId() {
		return id;
	}

	/**
	 * @param id the id to set
	 */
	public void setId(String id) {
		this.id = id;
	}

	/**
	 * @return the props
	 */
	public Properties getProps() {
		return props;
	}

	/**
	 * @param props the props to set
	 */
	public void setProps(Properties props) {
		this.props = props;
	}

	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "BeanConf [className=" + className + ", id=" + id + ", props=" + props + "]";
	}
	
	
}
