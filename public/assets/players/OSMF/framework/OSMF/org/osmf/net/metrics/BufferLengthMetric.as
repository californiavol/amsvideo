/*****************************************************
 *  
 *  Copyright 2011 Adobe Systems Incorporated.  All Rights Reserved.
 *  
 *****************************************************
 *  The contents of this file are subject to the Mozilla Public License
 *  Version 1.1 (the "License"); you may not use this file except in
 *  compliance with the License. You may obtain a copy of the License at
 *  http://www.mozilla.org/MPL/
 *   
 *  Software distributed under the License is distributed on an "AS IS"
 *  basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 *  License for the specific language governing rights and limitations
 *  under the License.
 *   
 *  
 *  The Initial Developer of the Original Code is Adobe Systems Incorporated.
 *  Portions created by Adobe Systems Incorporated are Copyright (C) 2011 Adobe Systems 
 *  Incorporated. All Rights Reserved. 
 *  
 *****************************************************/
package org.osmf.net.metrics
{
	import org.osmf.net.qos.QoSInfo;
	import org.osmf.net.qos.QoSInfoHistory;
	
	/**
	 * Metric providing the buffer length
	 * This metric's type is MetricType.BUFFER_LENGTH (<i>org.osmf.net.abr.metrics.bufferLength</i>)
	 *  
	 *  @langversion 3.0
	 *  @playerversion Flash 10
	 *  @playerversion AIR 1.5
	 *  @productversion OSMF 2.0
	 */
	public class BufferLengthMetric extends MetricBase
	{
		/**
		 * Constructor.
		 * 
		 * @param qosInfoHistory The QoSInfoHistory to be used for computing the metric 
		 * 
		 *  @langversion 3.0
		 *  @playerversion Flash 10
		 *  @playerversion AIR 1.5
		 *  @productversion OSMF 2.0
		 */
		public function BufferLengthMetric(qosInfoHistory:QoSInfoHistory)
		{
			super(qosInfoHistory, MetricType.BUFFER_LENGTH);
		}
		
		/**
		 * Computes the value of the buffer length metric
		 * 
		 *  @langversion 3.0
		 *  @playerversion Flash 10
		 *  @playerversion AIR 1.5
		 *  @productversion OSMF 2.0
		 */
		override protected function getValueForced():MetricValue
		{
			var qosInfo:QoSInfo = qosInfoHistory.getLatestQoSInfo();
			
			if (!isNaN(qosInfo.bufferLength) && qosInfo.bufferLength >= 0)
			{
				return new MetricValue(qosInfo.bufferLength, true);
			}
			
			return new MetricValue(undefined, false);
		}
	}
}